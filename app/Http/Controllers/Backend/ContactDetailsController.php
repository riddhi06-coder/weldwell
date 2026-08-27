<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ContactDetailsController extends Controller implements HasMiddleware
{
    /** Allowed image formats + size (2 MB — project-wide image cap). */
    private const IMAGE_RULES = 'image|mimes:jpg,jpeg,png,webp|max:2048';

    /** Office images are stored here (served directly from /public). */
    private const UPLOAD_DIR = 'contact/offices';

    public static function middleware(): array
    {
        return [
            new Middleware('permission:contact-details.view', only: ['index']),
            new Middleware('permission:contact-details.create', only: ['create', 'store']),
            new Middleware('permission:contact-details.edit', only: ['edit', 'update']),
            new Middleware('permission:contact-details.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $contacts = Contact::withCount(['socials', 'offices'])->orderByDesc('id')->get();

        return view('backend.contact.index', compact('contacts'));
    }

    public function create()
    {
        // Only one contact-details record is allowed — send them to edit the existing one.
        if ($contact = Contact::first()) {
            return redirect()->route('manage-contact-details.edit', $contact->id)
                ->with('message', 'Only one contact details record is allowed. You can edit the existing one.');
        }

        return view('backend.contact.create');
    }

    public function store(Request $request)
    {
        if (Contact::exists()) {
            return redirect()->route('manage-contact-details.index')
                ->with('message', 'Contact details already exist. Only one record is allowed.');
        }

        $request->validate($this->rules(), $this->messages());

        if (! $this->officesHaveImages($request)) {
            return back()->withErrors(['offices' => 'Each office must have an image.'])->withInput();
        }

        $contact = Contact::create($this->mainPayload($request));

        $this->syncSocials($contact, $request);
        $this->syncOffices($contact, $request);

        return redirect()->route('manage-contact-details.index')->with('message', 'Contact details added successfully.');
    }

    public function edit($id)
    {
        $contact = Contact::with(['socials', 'offices'])->findOrFail($id);

        return view('backend.contact.edit', compact('contact'));
    }

    public function update(Request $request, $id)
    {
        $contact = Contact::with('offices')->findOrFail($id);

        $request->validate($this->rules(), $this->messages());

        if (! $this->officesHaveImages($request)) {
            return back()->withErrors(['offices' => 'Each office must have an image.'])->withInput();
        }

        $contact->update($this->mainPayload($request));

        $this->syncSocials($contact, $request);
        $this->syncOffices($contact, $request);

        return redirect()->route('manage-contact-details.index')->with('message', 'Contact details updated successfully.');
    }

    public function destroy($id)
    {
        $contact = Contact::with('offices')->findOrFail($id);

        foreach ($contact->offices as $office) {
            $this->deleteImage($office->image);
        }
        // Contact is soft-deleted, so the DB FK cascade won't fire — remove children explicitly.
        $contact->offices()->delete();
        $contact->socials()->delete();
        $contact->delete();

        return redirect()->route('manage-contact-details.index')->with('message', 'Contact details deleted successfully.');
    }

    // ------------------------------------------------------------------ helpers

    private function rules(): array
    {
        $platforms = implode(',', array_keys(\App\Models\ContactSocial::PLATFORMS));

        return [
            'heading'                => 'required|string|max:255',
            'intro_message'          => 'required|string',
            'address_heading'        => 'required|string|max:255',

            'sidebar_company_name'   => 'required|string|max:255',
            'sidebar_desc'           => 'required|string',
            'sidebar_contact_no'     => 'required|string|max:50',
            'sidebar_email'          => 'required|email|max:255',
            'sidebar_website'        => 'required|string|max:255',

            'website_intro'          => 'required|string',
            'website_address'        => 'required|string',
            'email'                  => 'required|email|max:255',
            'telephone'              => 'required|string|max:50',
            'map_url'                => 'required|string',
            'iframe_url'             => 'required|string',

            'socials'                => 'required|array|min:1',
            'socials.*.platform'     => 'required|in:' . $platforms,
            'socials.*.url'          => 'required|url|max:255',

            'offices'                => 'required|array|min:1',
            'offices.*.office_name'  => 'required|string|max:255',
            'offices.*.address'      => 'required|string',
            'offices.*.emails'       => 'required|string|max:255',
            'offices.*.telephone'    => 'required|string|max:50',
            'offices.*.map_url'      => 'required|string',
            'offices.*.image'        => 'nullable|' . self::IMAGE_RULES,
        ];
    }

    private function messages(): array
    {
        return [
            'heading.required'            => 'Please enter the heading.',
            'intro_message.required'      => 'Please enter the intro message.',
            'address_heading.required'    => 'Please enter the address heading.',
            'sidebar_company_name.required' => 'Please enter the company name.',
            'sidebar_desc.required'       => 'Please enter the sidebar description.',
            'sidebar_contact_no.required' => 'Please enter the contact number.',
            'sidebar_email.required'      => 'Please enter the sidebar email.',
            'sidebar_email.email'         => 'Please enter a valid sidebar email address.',
            'sidebar_website.required'    => 'Please enter the website.',
            'website_intro.required'      => 'Please enter the website intro.',
            'website_address.required'    => 'Please enter the website address.',
            'email.required'              => 'Please enter the email.',
            'email.email'                 => 'Please enter a valid email address.',
            'telephone.required'          => 'Please enter the telephone number.',
            'map_url.required'            => 'Please enter the map URL.',
            'iframe_url.required'         => 'Please enter the iFrame URL.',
            'socials.required'            => 'Please add at least one social media link.',
            'socials.*.platform.required' => 'Please select a platform for each social link.',
            'socials.*.platform.in'       => 'Please select a valid platform.',
            'socials.*.url.required'      => 'Please enter the URL for each social link.',
            'socials.*.url.url'           => 'Each social link must be a valid URL.',
            'offices.required'            => 'Please add at least one office.',
            'offices.*.office_name.required' => 'Please enter the office name.',
            'offices.*.address.required'  => 'Please enter the office address.',
            'offices.*.emails.required'   => 'Please enter the office email(s).',
            'offices.*.telephone.required' => 'Please enter the office telephone number.',
            'offices.*.map_url.required'  => 'Please enter the office map URL.',
            'offices.*.image.image'       => 'Each office image must be a valid image.',
            'offices.*.image.mimes'       => 'Office images must be JPG, PNG or WebP.',
            'offices.*.image.max'         => 'Each office image must not be larger than 2 MB.',
        ];
    }

    /** Every office must have an image — a newly uploaded file or an existing one. */
    private function officesHaveImages(Request $request): bool
    {
        foreach ((array) $request->input('offices', []) as $i => $office) {
            if (empty($office['existing_image']) && ! $request->hasFile("offices.$i.image")) {
                return false;
            }
        }

        return true;
    }

    private function mainPayload(Request $request): array
    {
        return [
            'heading'         => $request->heading,
            'intro_message'   => $request->intro_message,
            'address_heading' => $request->address_heading,
            'sidebar_company_name' => $request->sidebar_company_name,
            'sidebar_desc'         => $request->sidebar_desc,
            'sidebar_contact_no'   => $request->sidebar_contact_no,
            'sidebar_email'        => $request->sidebar_email,
            'sidebar_website'      => $request->sidebar_website,
            'website_intro'   => $request->website_intro,
            'website_address' => $request->website_address,
            'email'           => $request->email,
            'telephone'       => $request->telephone,
            'map_url'         => $request->map_url,
            'iframe_url'      => $request->iframe_url,
            'is_active'       => $request->boolean('is_active'),
        ];
    }

    /** Replace the contact's social links (rows missing both fields are skipped). */
    private function syncSocials(Contact $contact, Request $request): void
    {
        $contact->socials()->delete();

        $order = 0;
        foreach ((array) $request->input('socials', []) as $social) {
            $platform = trim($social['platform'] ?? '');
            $url      = trim($social['url'] ?? '');
            if ($url === '' && $platform === '') {
                continue;
            }

            $contact->socials()->create([
                'platform'   => $platform,
                'url'        => $url,
                'sort_order' => $order++,
            ]);
        }
    }

    /**
     * Replace the contact's office blocks. Existing images are kept (via the
     * hidden existing_image field) unless a new file replaces them; images of
     * removed offices are deleted from disk.
     */
    private function syncOffices(Contact $contact, Request $request): void
    {
        $submitted = (array) $request->input('offices', []);
        $oldImages = $contact->offices->pluck('image')->filter()->values()->all();

        $newRows    = [];
        $usedImages = [];

        foreach ($submitted as $i => $office) {
            $name = trim($office['office_name'] ?? '');

            // Resolve the image: a newly uploaded file wins, otherwise keep the existing one.
            $image = $office['existing_image'] ?? null;
            if ($request->hasFile("offices.$i.image")) {
                $image = $this->storeImage($request->file("offices.$i.image"));
            }

            // Skip an office block that is entirely empty.
            if ($name === '' && ! $image && empty($office['address']) && empty($office['emails'])
                && empty($office['telephone']) && empty($office['map_url'])) {
                continue;
            }

            if ($image) {
                $usedImages[] = $image;
            }

            $newRows[] = [
                'image'       => $image,
                'office_name' => $name,
                'address'     => $office['address'] ?? null,
                'emails'      => $office['emails'] ?? null,
                'telephone'   => $office['telephone'] ?? null,
                'map_url'     => $office['map_url'] ?? null,
            ];
        }

        // Delete image files that are no longer referenced by any office.
        foreach ($oldImages as $img) {
            if (! in_array($img, $usedImages, true)) {
                $this->deleteImage($img);
            }
        }

        $contact->offices()->delete();

        foreach ($newRows as $order => $row) {
            $contact->offices()->create($row + ['sort_order' => $order]);
        }
    }

    /** Move an uploaded office image into /public/contact/offices and return its filename. */
    private function storeImage($file): ?string
    {
        if (! $file) {
            return null;
        }

        $folder = public_path(self::UPLOAD_DIR);
        if (! file_exists($folder)) {
            mkdir($folder, 0755, true);
        }

        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($folder, $fileName);

        return $fileName;
    }

    private function deleteImage(?string $fileName): void
    {
        if ($fileName && file_exists(public_path(self::UPLOAD_DIR . '/' . $fileName))) {
            @unlink(public_path(self::UPLOAD_DIR . '/' . $fileName));
        }
    }
}
