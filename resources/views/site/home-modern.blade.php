@extends('site.layouts.app')

@section('content')
<section class="zr-hero py-5">
    <div class="container py-5">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <span class="badge rounded-pill bg-primary-subtle text-primary px-3 py-2 mb-3">University of Zalingei</span>
                <h1 class="display-4 fw-bold mb-3">Knowledge, research and service to the community</h1>
                <p class="lead text-muted mb-4">Discover university services, colleges, academic programs, news and the Student Portal from one secure platform.</p>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ url('/student-portal') }}" class="btn btn-primary btn-lg px-4">Student Portal</a>
                    <a href="{{ url('/contact') }}" class="btn btn-outline-primary btn-lg px-4">Contact Us</a>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card border-0 shadow-lg rounded-4 p-4">
                    <h3 class="fw-bold">University Systems</h3>
                    <div class="row g-3 mt-1">
                        <div class="col-6"><div class="p-3 rounded-3 bg-light"><strong>OJS</strong><small class="d-block text-muted">Scientific Journals</small></div></div>
                        <div class="col-6"><div class="p-3 rounded-3 bg-light"><strong>KOHA</strong><small class="d-block text-muted">Digital Library</small></div></div>
                        <div class="col-6"><div class="p-3 rounded-3 bg-light"><strong>DSpace</strong><small class="d-block text-muted">Digital Repository</small></div></div>
                        <div class="col-6"><div class="p-3 rounded-3 bg-light"><strong>Portal</strong><small class="d-block text-muted">Student Services</small></div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div><span class="text-primary fw-semibold">ACADEMIC EDUCATION</span><h2 class="fw-bold mb-0">University Colleges</h2></div>
            <a href="{{ url('/college') }}" class="btn btn-outline-primary">View All</a>
        </div>
        <div class="row g-4">
            @foreach(['Faculty of Medicine','College of Health Sciences','Faculty of Agriculture','Faculty of Education','Faculty of Economics and Administrative Sciences','Faculty of Computer Science and Information Technology','Faculty of Graduate Studies and Scientific Research','Faculty of Animal Production Science and Technology'] as $college)
                <div class="col-md-6 col-lg-3"><div class="card h-100 border-0 shadow-sm rounded-4"><div class="card-body p-4"><div class="text-primary fs-3 mb-3">▦</div><h5 class="fw-bold">{{ $college }}</h5><a href="{{ url('/college') }}" class="stretched-link text-decoration-none">Explore college</a></div></div></div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4"><div class="p-4 rounded-4 bg-primary text-white h-100"><span class="small">STUDENT SERVICES</span><h3 class="fw-bold mt-2">Everything students need</h3><p class="opacity-75">Registration and results services are available through the Student Portal.</p><a href="{{ url('/student-portal') }}" class="btn btn-light">Open Student Portal</a></div></div>
            <div class="col-lg-8"><div class="card border-0 shadow-sm rounded-4 h-100"><div class="card-body p-4"><div class="d-flex justify-content-between"><div><span class="text-primary fw-semibold">UPDATES</span><h3 class="fw-bold">News for Students</h3></div><a href="{{ url('/news') }}" class="btn btn-outline-primary align-self-start">All News</a></div><p class="text-muted mb-0">Stay informed about university announcements, academic activities and student services.</p></div></div></div>
        </div>
    </div>
</section>
@endsection
