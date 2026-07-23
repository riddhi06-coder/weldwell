<!doctype html>
<html lang="en">

<head>
    @include('components.backend.head')

    <style>
        body {
            background: #f4f6f9;
        }

        .welcome-card {
            background: #ffffff;
            border: 1px solid #e6e6e6;
            border-radius: 16px;
            padding: 48px 40px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .welcome-card h2 {
            font-weight: 700;
            color: #1c2331;
            margin-bottom: 10px;
        }

        .welcome-card p {
            color: #6b7280;
            margin-bottom: 0;
        }
    </style>

</head>

    @include('components.backend.header')

    <!--start sidebar wrapper-->
    @include('components.backend.sidebar')
    <!--end sidebar wrapper-->

    <div class="page-body">

        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="welcome-card">
                        <h2>Welcome to WeldWell</h2>
                        <p>Your admin dashboard is set up. Content will be added soon.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Container-fluid Ends -->
        </div>
        <!-- footer start-->
        @include('components.backend.footer')
    </div>

    </div>

    @include('components.backend.main-js')

</body>

</html>
