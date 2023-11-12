@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Beranda Sekretaris Kwarcab</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Beranda</a></li>
                        <li class="breadcrumb-item active">Admin</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-sm-6 col-12 d-flex">
            <div class="card bg-comman w-100">
                <div class="card-body">
                    <div class="db-widgets d-flex justify-content-between align-items-center">
                        <div class="db-info">
                            <h6>Students</h6>
                            <h3>50055</h3>
                        </div>
                        <div class="db-icon">
                            <img src="assets/img/icons/dash-icon-01.svg" alt="Dashboard Icon">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12 d-flex">
            <div class="card bg-comman w-100">
                <div class="card-body">
                    <div class="db-widgets d-flex justify-content-between align-items-center">
                        <div class="db-info">
                            <h6>Awards</h6>
                            <h3>50+</h3>
                        </div>
                        <div class="db-icon">
                            <img src="assets/img/icons/dash-icon-02.svg" alt="Dashboard Icon">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12 d-flex">
            <div class="card bg-comman w-100">
                <div class="card-body">
                    <div class="db-widgets d-flex justify-content-between align-items-center">
                        <div class="db-info">
                            <h6>Department</h6>
                            <h3>30+</h3>
                        </div>
                        <div class="db-icon">
                            <img src="assets/img/icons/dash-icon-03.svg" alt="Dashboard Icon">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12 d-flex">
            <div class="card bg-comman w-100">
                <div class="card-body">
                    <div class="db-widgets d-flex justify-content-between align-items-center">
                        <div class="db-info">
                            <h6>Revenue</h6>
                            <h3>$505</h3>
                        </div>
                        <div class="db-icon">
                            <img src="assets/img/icons/dash-icon-04.svg" alt="Dashboard Icon">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0 card-title" style="text-align: center;">Progres Peminjaman</h4>
                </div>
                <div class="card-body">
                    <div id="basic-pills-wizard" class="twitter-bs-wizard">
                        <ul class="twitter-bs-wizard-nav">
                            <li class="nav-item">
                                <a href="#seller-details" class="nav-link" data-toggle="tab">
                                    <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Seller Details">
                                        <i class="far fa-user"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#company-document" class="nav-link" data-toggle="tab">
                                    <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Company Document">
                                        <i class="fas fa-map-pin"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#bank-detail" class="nav-link" data-toggle="tab">
                                    <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Bank Details">
                                        <i class="fas fa-credit-card"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content twitter-bs-wizard-tab-content">
                            <div class="tab-pane" id="seller-details">
                                <div class="mb-4">
                                    <h5>Enter Your Personal Details</h5>
                                </div>
                                <form>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="basicpill-firstname-input" class="form-label">First
                                                    name</label>
                                                <input type="text" class="form-control" id="basicpill-firstname-input">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="basicpill-lastname-input" class="form-label">Last name</label>
                                                <input type="text" class="form-control" id="basicpill-lastname-input">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="basicpill-phoneno-input" class="form-label">Phone</label>
                                                <input type="text" class="form-control" id="basicpill-phoneno-input">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="basicpill-email-input" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="basicpill-email-input">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <ul class="pager wizard twitter-bs-wizard-pager-link">
                                    <li class="next"><a href="javascript: void(0);" class="btn btn-primary"
                                            onclick="nextTab()">Next <i class="bx bx-chevron-right ms-1"></i></a></li>
                                </ul>
                            </div>

                            <div class="tab-pane" id="company-document">
                                <div>
                                    <div class="mb-4">
                                        <h5>Enter Your Address</h5>
                                    </div>
                                    <form>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="basicpill-pancard-input" class="form-label">Address
                                                        1</label>
                                                    <input type="text" class="form-control"
                                                        id="basicpill-pancard-input">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="basicpill-vatno-input" class="form-label">Address
                                                        2</label>
                                                    <input type="text" class="form-control"
                                                        id="basicpill-vatno-input">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="basicpill-cstno-input" class="form-label">Landmark</label>
                                                    <input type="text" class="form-control"
                                                        id="basicpill-cstno-input">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="basicpill-servicetax-input"
                                                        class="form-label">Town</label>
                                                    <input type="text" class="form-control"
                                                        id="basicpill-servicetax-input">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <ul class="pager wizard twitter-bs-wizard-pager-link">
                                        <li class="previous"><a href="javascript: void(0);" class="btn btn-primary"
                                                onclick="nextTab()"><i class="bx bx-chevron-left me-1"></i> Previous</a>
                                        </li>
                                        <li class="next"><a href="javascript: void(0);" class="btn btn-primary"
                                                onclick="nextTab()">Next <i class="bx bx-chevron-right ms-1"></i></a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="tab-pane" id="bank-detail">
                                <div>
                                    <div class="mb-4">
                                        <h5>Payment Details</h5>
                                    </div>
                                    <form>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="basicpill-namecard-input" class="form-label">Name on
                                                        Card</label>
                                                    <input type="text" class="form-control"
                                                        id="basicpill-namecard-input">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Credit Card Type</label>
                                                    <select class="form-select">
                                                        <option selected>Select Card Type</option>
                                                        <option value="AE">American Express</option>
                                                        <option value="VI">Visa</option>
                                                        <option value="MC">MasterCard</option>
                                                        <option value="DI">Discover</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="basicpill-cardno-input" class="form-label">Credit Card
                                                        Number</label>
                                                    <input type="text" class="form-control"
                                                        id="basicpill-cardno-input">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="basicpill-card-verification-input" class="form-label">Card
                                                        Verification Number</label>
                                                    <input type="text" class="form-control"
                                                        id="basicpill-card-verification-input">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="basicpill-expiration-input" class="form-label">Expiration
                                                        Date</label>
                                                    <input type="text" class="form-control"
                                                        id="basicpill-expiration-input">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <ul class="pager wizard twitter-bs-wizard-pager-link">
                                        <li class="previous"><a href="javascript: void(0);" class="btn btn-primary"
                                                onclick="nextTab()"><i class="bx bx-chevron-left me-1"></i> Previous</a>
                                        </li>
                                        <li class="float-end"><a href="javascript: void(0);" class="btn btn-primary"
                                                data-bs-toggle="modal" data-bs-target=".confirmModal">Save
                                                Changes</a></li>
                                    </ul>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ URL::to('assets/js/feather.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/twitter-bootstrap-wizard/prettify.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/twitter-bootstrap-wizard/form-wizard.js') }}"></script>
@endpush
