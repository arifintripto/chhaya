
@include('layouts.default.includes.page_header')
<!-- Page -->
<div class="section contact">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-md-4 col-md-push-8">

                <div class="widget contact-info-sidebar">
                    <div class="widget-title">
                        Contact Info
                    </div>
                    <ul class="list-info">
                        <li>
                            <div class="info-icon">
                                <span class="fa fa-map-marker"></span>
                            </div>
                            <div class="info-text">{!! $settings->address !!}</div>
                        </li>
                        <li>
                            <div class="info-icon">
                                <span class="fa fa-phone"></span>
                            </div>
                            <div class="info-text">{{ $settings->phone }}</div>
                        </li>
                        <li>
                            <div class="info-icon">
                                <span class="fa fa-envelope"></span>
                            </div>
                            <div class="info-text"><a href="mailto:{{ $settings->email }}">{{ $settings->email }}</a></div>
                        </li>
                        <li>
                            <div class="info-icon">
                                <span class="fa fa-clock-o"></span>
                            </div>
                            <div class="info-text">{!! $settings->hours !!}</div>
                        </li>
                    </ul>
                </div>

            </div>
            <div class="col-sm-8 col-md-8 col-md-pull-4">
                <div class="content">
                    <h2 class="section-heading mt-0">
                        We are here to help
                    </h2>
                    <p></p>
                    <div class="margin-bottom-30"></div>

                    <form action="#" class="form-contact" id="contactForm" data-toggle="validator" novalidate="true">
                        <div class="form-group">
                            <input type="text" class="form-control" id="p_name" placeholder="Full Name..." required="">
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <input type="email" class="form-control" id="email" placeholder="Email...">
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="p_name" placeholder="Organization..." required="">
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="p_name" placeholder="Designation..." required="">
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="p_email" placeholder="Phone Number..." required="">
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                             <textarea id="p_message" class="form-control" rows="6" placeholder="Write your message"></textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <div id="success"></div>
                            <button type="submit" class="btn btn-secondary">Submit</button>
                        </div>
                    </form>
                    <div class="margin-bottom-50"></div>
                 </div>
            </div>

        </div>

    </div>
</div>
