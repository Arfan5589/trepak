<link rel="stylesheet" href="{{ asset('inteltelphone/css/intlTelInput.min.css') }}">
<style>
    #footer {
        transform: translateY(110px);
    }

    .alink {
        display: inline-block;
        text-align: center;
        cursor: pointer;
    }

    input[type="text"],
    button {
        padding: 4px 8px;
        border: 0;
        outline: 0;
    }

    button {
        background-color: transparent;
        cursor: pointer;
    }

    button:hover i {
        color: #79c7c5;
        transform: scale(1.2);
    }

    /* container */
    .customchatbox {
        width: 450px;
        height: 70vh;
        position: fixed;
        bottom: 2%;
        right: 2%;
        /* transform: translate(-50%, -50%); */
        z-index: 1;
        border-radius: 10px;
        background-color: #f9fbff;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        overflow: hidden;
    }

    /* chat_box */
    .chat_box {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .chat_box>* {
        padding: 8px;
    }

    /* head */
    .head {
        display: flex;
        align-items: center;
    }

    .head .user {
        display: flex;
        align-items: center;
        flex-grow: 1;
    }

    .head .user .avatar {
        margin-right: 8px;
    }

    .head .user .avatar img {
        display: block;
        border-radius: 50%;
    }

    .head .bar_tool {
        display: flex;
    }

    .head .bar_tool i {
        padding: 5px;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* body */
    .chatbody {
        flex-grow: 1;
        background-color: #eee;
        overflow-y: auto;
        height: 500px;
    }

    .chatbody .bubble {
        display: inline-block;
        padding: 10px;
        margin-bottom: 5px;
        border-radius: 15px;
    }

    .chatbody .bubble p {
        color: #f9fbff;
        font-size: 14px;
        text-align: left;
        line-height: 0.6;
        padding: 4px;
        margin-bottom: 0px;
        margin-top: 0px;
    }

    .chatbody .incoming {
        text-align: left;
    }

    .chatbody .incoming .bubble {
        background-color: #b2b2b2;
    }

    .chatbody .outgoing {
        text-align: right;
    }

    .chatbody .outgoing .bubble {
        background-color: #79c7c5;
    }

    /* foot */
    .foot {
        display: flex;
    }

    .foot .msg {
        flex-grow: 1;
    }


    @media screen and (max-width:520px) {

        .customchatbox {
            width: 315px;
            height: 70vh;
        }
    }
</style>
<div class="breadcrumb-bar topsection">

    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Engineer Profile</li>
                    </ol>
                </nav>
                <h2 class="breadcrumb-title">Engineer Profile</h2>
            </div>
        </div>
    </div>
</div>
<!-- /Breadcrumb -->
@php
    if (session()->has('indexengrid')) {
        session()->forget('indexengrid');
        session()->forget('indexroute');
    }
@endphp
{{-- ==========================chat box ========================	 --}}

{{-- ===========modal for select order date================== --}}
<div class="modal" tabindex="-1" role="dialog" id="orderdetail_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Book Order Modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('proceed') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="selectdateorder">Select Date</label>
                        <input class="form-control" type="date" name="engr_date" id="selectdateorder"
                            min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>">
                        <input class="form-control" type="text" value="{{ $engr->id }}" name="engr_id" hidden>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Place Order</button>
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                </div>
            </form>

        </div>
    </div>
</div>
{{-- ===========modal for select order date================== --}}

{{-- ===========modal for Video Consultation================== --}}
<div class="modal" tabindex="-1" role="dialog" id="videoconsultant_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Video Consultant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('videoconsultantbook') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="client_date">Select Date</label>
                        <input class="form-control" type="date" name="client_date" id="client_date"
                            min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>" required>
                        <input class="form-control" type="text" value="{{ $engr->id }}" name="engr_id_video"
                            hidden>
                        <input class="form-control" type="text" value="{{ Auth::user()->id }}" name="client_id_video"
                            hidden>

                    </div>
                    <div class="form-group">
                        <label for="client_time">Select Time</label>
                        <input class="form-control" type="time" name="client_time" id="client_time" min="08:00:00"
                            max="20:00:00" required>


                    </div>
                    <div class="form-group">
                        <label for="mobile">Mobile</label>
                        <input type="text" class="form-control" name="mobile" id="mobile"
                            style="border: 1px solid #dfd8d8;" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Book Video Consultation</button>
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                </div>
            </form>

        </div>
    </div>
</div>
{{-- ===========modal for select Video Consultation================== --}}

<div class="container customchatbox" style="display:none">
    <div class="chat_box">
        <div class="head">
            <div class="user">
                <div class="avatar" style="position: relative">
                    <img id="picofreciver" />
                    <i class="fa fa-circle showonline_status_engr"
                        style="font-size:12px;position:absolute;right:3px;top:0px"></i>
                </div>
                <div class="name" id="nameofreciver">
                    <span id="name_engineer"></span>


                </div>
            </div>
            <ul class="bar_tool">
                <li><span class="alink"><a href="javascript:void(0)" onclick="closeclientchatbox()"><i
                                class="fa fa-times" aria-hidden="true"></i></a></span></li>
            </ul>
        </div>
        <div class="chatbody" id="chatbody{{ getuseronline() }}">
            <div id="chatbox{{ $engr->id }}">
                <div class="incoming">
                    <div class="bubble">
                        <p>What are you getting.. Oh, oops sorry dude.</p>
                    </div>
                </div>
                <div class="outgoing">
                    <div class="bubble lower">
                        <p>Nah, it's cool.</p>
                    </div>
                    <div class="bubble">
                        <p>Well you should get your Dad a cologne. Here smell it. Oh wait! ...</p>
                    </div>
                </div>
            </div>


        </div>
        <div class="foot" style="position: relative">
            <form method='post' action="#">
                @csrf
                <input type="text" name="message" id="message" class="msg"
                    placeholder="Type a message..." />
                <input type="text" name="senderid" id="senderid"
                    value="{{ Auth::check() ? Auth::user()->id : '' }}" hidden />
                <input type="text" name="reciverid" id="reciverid" value="{{ $engr->id }}" hidden />
                <button type="submit" id="submitmsg" style="position: absolute;right:2px;"><i
                        class="fas fa-paper-plane"></i></button>
            </form>
        </div>
    </div>
</div>
{{-- ==========================chat box ========================	 --}}
<!-- Page Content -->
<div class="content">
    <div class="container">

        <!-- Doctor Widget -->
        <div class="card">
            <div class="card-body">
                <div class="doctor-widget">
                    <div class="doc-info-left">
                        @php
                            if ($engr->signupoption == 1) {
                                $engrimg = $engr->pic;
                            } else {
                                $engrimg = asset('engrphoto/' . $engr->pic);
                            }
                        @endphp
                        <div class="doctor-img" style="position:relative">
                            {{-- <a href="doctor-profile.html"> --}}
                            <i id="showonline_status_{{ $engr->id }}" class="fa fa-circle showonline_status"
                                style="font-size:12px;color:{{ $engr->onlinestatus }};position:absolute;right:-3px;top:-3px"></i>
                            <img src="{{ $engrimg }}" alt="Engr Image" style="width: 100%;height: 100%;">
                            <input type="hidden" id="engineer_id_status" value="{{ $engr->id }}">
                            <input type="hidden" id="engineer_status_color" value="{{ $engr->onlinestatus }}">

                            {{-- </a> --}}
                        </div>
                        {{-- <div class="doctor-img">
										<img src="{{ $engrimg }}" class="img-fluid" alt="User Image">
									</div> --}}
                        <div class="doc-info-cont">
                            <h4 class="doc-name">{{ $engr->fname }}</h4>
                            <p class="doc-speciality">{{ getcategoryname($engr->engrcategoryid) }}</p>
                            {{-- <p class="doc-department"><img src="{{ asset('newpanel/assets/img/specialities/specialities-05.png') }}" class="img-fluid" alt="Speciality">{{ $engr->specialization }}</p> --}}
                            <div class="rating">
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star"></i>
                                <span class="d-inline-block average-rating">(35)</span>
                            </div>
                            <div class="clinic-details">
                                <p class="doc-location"><i class="fas fa-map-marker-alt"></i>
                                    {{ $engr->city . ' ' . $engr->state . ', ' . $engr->country }} </p>
                                {{-- <ul class="clinic-gallery">
												<li>
													<a href=" {{ asset('newpanel/assets/img/features/feature-01.jpg') }}" data-fancybox="gallery">
														<img src="{{ asset('newpanel/assets/img/features/feature-01.jpg') }}" alt="Feature">
													</a>
												</li>
												<li>
													<a href="{{ asset('newpanel/assets/img/features/feature-02.jpg') }}" data-fancybox="gallery">
														<img  src="{{ asset('newpanel/assets/img/features/feature-02.jpg') }}" alt="Feature Image">
													</a>
												</li>
												<li>
													<a href="{{ asset('newpanel/assets/img/features/feature-03.jpg') }}" data-fancybox="gallery">
														<img src="{{ asset('newpanel/assets/img/features/feature-03.jpg') }}" alt="Feature">
													</a>
												</li>
												<li>
													<a href=" {{ asset('newpanel/assets/img/features/feature-04.jpg') }}" data-fancybox="gallery">
														<img src="{{ asset('newpanel/assets/img/features/feature-04.jpg') }}" alt="Feature">
													</a>
												</li>
											</ul> --}}
                            </div>
                            <div id="showhideactionbtn" class="mt-2">
                                <div class="clini-infos">
                                    <ul>

                                        {{-- <li><i class="far fa-money-bill-alt"></i> ${{ $engr->pricerange }} per hour </li> --}}
                                        <li>
                                            <a href="javascript:void(0)"
                                                onclick="clientchat_box({{ $engr->id }},{{ Auth::check() ? Auth::user()->id : '' }},'{{ $engr->fname }}','{{ $engrimg }}','{{ $engr->onlinestatus }}')">
                                                <i class="far fa-comment-alt"></i> Chat
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <button onclick="showmodelvideo()" class="btn btn-primary">Book Video
                                    Consultation</button>
                                <button onclick="shoemodeldate()" class="btn btn-primary"
                                    style="padding: 8px 33px;margin-top: 5px;">Book Appointment</button>

                                {{-- <a class="apt-btn" href="{{ route('booking',['id'=>$engr->id]) }}">Book Appointment</a> --}}
                            </div>
                            {{-- <div class="clinic-services">
											<span>AUTO CAD</span>
											<span>3D GRAPH</span>
										</div> --}}
                        </div>
                    </div>
                    <div class="doc-info-right">
                        <div class="clini-infos">
                            <ul>
                                <li><i class="far fa-thumbs-up"></i> 99%</li>
                                {{-- <li><i class="far fa-money-bill-alt"></i> ${{ $engr->pricerange }} per hour </li> --}}
                                <li>
                                    <a href="javascript:void(0)"
                                        onclick="clientchat_box({{ $engr->id }},{{ Auth::check() ? Auth::user()->id : '' }},'{{ $engr->fname }}','{{ $engrimg }}','{{ $engr->onlinestatus }}')">
                                        <i class="far fa-comment-alt"></i> Chat
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="clinic-booking">

                            <button onclick="showmodelvideo()" class="btn btn-primary">Book Video
                                Consultation</button>
                            <button onclick="shoemodeldate()" class="btn btn-primary "
                                style="padding: 0px 33px;margin-top: 5px;">Book Appointment</button>

                            {{-- <a class="apt-btn" href="{{ route('booking',['id'=>$engr->id]) }}">Book Appointment</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Doctor Widget -->

        <!-- Doctor Details Tab -->
        <div class="card">
            <div class="card-body pt-0">

                <!-- Tab Menu -->
                <nav class="user-tabs mb-4">
                    <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                        <li class="nav-item">
                            <a class="nav-link active" href="#doc_overview" data-toggle="tab">Overview</a>
                        </li>
                        {{-- <li class="nav-item">
										<a class="nav-link" href="#doc_locations" data-toggle="tab">Locations</a>
									</li> --}}
                        <li class="nav-item">
                            <a class="nav-link" href="#doc_reviews" data-toggle="tab">Reviews</a>
                        </li>
                        {{-- <li class="nav-item">
										<a class="nav-link" href="#doc_business_hours" data-toggle="tab">Comments</a>
									</li> --}}
                    </ul>
                </nav>
                <!-- /Tab Menu -->

                <!-- Tab Content -->
                <div class="tab-content pt-0">

                    <!-- Overview Content -->
                    <div role="tabpanel" id="doc_overview" class="tab-pane fade show active">
                        <div class="row">
                            <div class="col-md-12 col-lg-9">

                                <!-- About Details -->
                                <div class="widget about-widget">
                                    <h3 class="widget-title">About Me</h3>
                                    <p>{{ $engr->about }}.</p>
                                    <a href="{{ asset('engr_cv/' . $engr->cv) }}" tabindex="-1">Download CV</a>

                                </div>
                                <!-- /About Details -->

                                <!-- Education Details -->
                                <div class="widget education-widget">
                                    {{-- <h3 class="widget-title">CV</h3> --}}
                                    <div class="experience-box">
                                        {{-- <iframe
														src="https://drive.google.com/viewerng/viewer?embedded=true&url=http://infolab.stanford.edu/pub/papers/{{ $engr->cv }}#toolbar=0&scrollbar=0"
														frameBorder="0"
														scrolling="auto"
														height="100%"
														width="100%"
													></iframe> --}}
                                        {{-- {{ asset('engr_cv/'.$engr->cv) }} --}}
                                        {{-- @php
														$engrcv = explode('.',$engr->cv);
													
													@endphp --}}
                                        {{-- <iframe src="{{ asset('engr_cv/'.$engr->cv) }}" width="100%" height="500px"></iframe> --}}
                                        {{-- <object width="400px" height="400px" data="{{ asset('engr_cv/'.$engr->cv) }}"></object> --}}
                                        {{-- <iframe src="{{ asset('engr_cv/'.$engr->cv) }}"
														style="width:600px; height:500px;" frameborder="0">
													</iframe> --}}
                                        {{-- {{ asset('engr_cv/'.$engr->cv) }}
													<embed src="{{ asset('engr_cv/AAFinal.pdf') }}" type="application/pdf" > --}}
                                        {{-- <ul class="experience-list">
														<li>
															<div class="experience-user">
																<div class="before-circle"></div>
															</div>
															<div class="experience-content">
																<div class="timeline-content">
																	{{-- <a href="#/" class="name">{{ $engr->university }}</a>
																	
																	<div>{{ $engr->education }}</div> --}}
                                        {{-- <span class="time">{{ $engr->degreedate }}</span> --
																</div>
															</div>
														</li>
													</ul> --}}
                                    </div>
                                </div>
                                <!-- /Education Details -->

                                <!-- Experience Details -->
                                {{-- <div class="widget experience-widget">
												<h4 class="widget-title">Work & Experience</h4>
												<div class="experience-box">
													<ul class="experience-list">
														<li>
															<div class="experience-user">
																<div class="before-circle"></div>
															</div>
															<div class="experience-content">
																<div class="timeline-content">
																	{{-- <a href="#/" class="name">{{ $engr->company }}</a> --}}
                                {{-- <span class="time">{{ $engr->experience }}(years)</span> --
																</div>
															</div>
														</li>
														
														{{-- <li>
															<div class="experience-user">
																<div class="before-circle"></div>
															</div>
															<div class="experience-content">
																<div class="timeline-content">
																	<a href="#/" class="name">Dream Smile Dental Practice</a>
																	<span class="time">2005 - 2007 (2 years)</span>
																</div>
															</div>
														</li> --
													</ul>
												</div>
											</div> --}}
                                <!-- /Experience Details -->

                                {{-- <!-- Awards Details -->
											<div class="widget awards-widget">
												<h4 class="widget-title">Awards</h4>
												<div class="experience-box">
													<ul class="experience-list">
														<li>
															<div class="experience-user">
																<div class="before-circle"></div>
															</div>
															<div class="experience-content">
																<div class="timeline-content">
																	<p class="exp-year">July 2019</p>
																	<h4 class="exp-title">Humanitarian Award</h4>
																	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin a ipsum tellus. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>
																</div>
															</div>
														</li>
														<li>
															<div class="experience-user">
																<div class="before-circle"></div>
															</div>
															<div class="experience-content">
																<div class="timeline-content">
																	<p class="exp-year">March 2011</p>
																	<h4 class="exp-title">Certificate for International Volunteer Service</h4>
																	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin a ipsum tellus. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>
																</div>
															</div>
														</li>
														<li>
															<div class="experience-user">
																<div class="before-circle"></div>
															</div>
															<div class="experience-content">
																<div class="timeline-content">
																	<p class="exp-year">May 2008</p>
																	<h4 class="exp-title">The Dental Professional of The Year Award</h4>
																	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin a ipsum tellus. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>
																</div>
															</div>
														</li>
													</ul>
												</div>
											</div>
											<!-- /Awards Details --> --}}

                                <!-- Services List -->
                                {{-- <div class="service-list">
												<h4>Services</h4>
												<ul class="clearfix">
													<li>Construction </li>
													<li>3D Graph</li>
													<li>Auto Cad</li>
													<li>House Design</li>
													
												</ul>
											</div> --}}
                                <!-- /Services List -->

                                {{-- <!-- Specializations List -->
											<div class="service-list">
												<h4>Specializations</h4>
												<ul class="clearfix">
													<li>Children Care</li>
													<li>Dental Care</li>	
													<li>Oral and Maxillofacial Surgery </li>	
													<li>Orthodontist</li>	
													<li>Periodontist</li>	
													<li>Prosthodontics</li>	
												</ul>
											</div>
											<!-- /Specializations List --> --}}

                            </div>
                        </div>
                    </div>
                    <!-- /Overview Content -->

                    {{-- <!-- Locations Content -->
								<div role="tabpanel" id="doc_locations" class="tab-pane fade">
								
									<!-- Location List -->
									<div class="location-list">
										<div class="row">
										
											<!-- Clinic Content -->
											<div class="col-md-6">
												<div class="clinic-content">
													<h4 class="clinic-name"><a href="#">Smile Cute Dental Care Center</a></h4>
													<p class="doc-speciality">MDS - Periodontology and Oral Implantology, BDS</p>
													<div class="rating">
														<i class="fas fa-star filled"></i>
														<i class="fas fa-star filled"></i>
														<i class="fas fa-star filled"></i>
														<i class="fas fa-star filled"></i>
														<i class="fas fa-star"></i>
														<span class="d-inline-block average-rating">(4)</span>
													</div>
													<div class="clinic-details mb-0">
														<h5 class="clinic-direction"> <i class="fas fa-map-marker-alt"></i> 2286  Sundown Lane, Austin, Texas 78749, USA <br><a href="javascript:void(0);">Get Directions</a></h5>
														<ul>
															<li>
																<a href="{{ asset('newpanel/assets/img/features/feature-01.jpg') }}" data-fancybox="gallery2">
																	<img src="{{ asset('newpanel/assets/img/features/feature-01.jpg') }}" alt="Feature Image">
																</a>
															</li>
															<li>
																<a href="{{ asset('newpanel/assets/img/features/feature-02.jpg') }}" data-fancybox="gallery2">
																	<img src="{{ asset('newpanel/assets/img/features/feature-02.jpg') }}" alt="Feature Image">
																</a>
															</li>
															<li>
																<a href="{{ asset('newpanel/assets/img/features/feature-03.jpg') }}" data-fancybox="gallery2">
																	<img src="{{ asset('newpanel/assets/img/features/feature-03.jpg') }}" alt="Feature Image">
																</a>
															</li>
															<li>
																<a href="{{ asset('newpanel/assets/img/features/feature-04.jpg') }}" data-fancybox="gallery2">
																	<img src="{{ asset('newpanel/assets/img/features/feature-04.jpg') }}" alt="Feature Image">
																</a>
															</li>
														</ul>
													</div>
												</div>
											</div>
											<!-- /Clinic Content -->
											
											<!-- Clinic Timing -->
											<div class="col-md-4">
												<div class="clinic-timing">
													<div>
														<p class="timings-days">
															<span> Mon - Sat </span>
														</p>
														<p class="timings-times">
															<span>10:00 AM - 2:00 PM</span>
															<span>4:00 PM - 9:00 PM</span>
														</p>
													</div>
													<div>
													<p class="timings-days">
														<span>Sun</span>
													</p>
													<p class="timings-times">
														<span>10:00 AM - 2:00 PM</span>
													</p>
													</div>
												</div>
											</div>
											<!-- /Clinic Timing -->
											
											<div class="col-md-2">
												<div class="consult-price">
													$250
												</div>
											</div>
										</div>
									</div>
									<!-- /Location List -->
									
									<!-- Location List -->
									<div class="location-list">
										<div class="row">
										
											<!-- Clinic Content -->
											<div class="col-md-6">
												<div class="clinic-content">
													<h4 class="clinic-name"><a href="#">The Family Dentistry Clinic</a></h4>
													<p class="doc-speciality">MDS - Periodontology and Oral Implantology, BDS</p>
													<div class="rating">
														<i class="fas fa-star filled"></i>
														<i class="fas fa-star filled"></i>
														<i class="fas fa-star filled"></i>
														<i class="fas fa-star filled"></i>
														<i class="fas fa-star"></i>
														<span class="d-inline-block average-rating">(4)</span>
													</div>
													<div class="clinic-details mb-0">
														<p class="clinic-direction"> <i class="fas fa-map-marker-alt"></i> 2883  University Street, Seattle, Texas Washington, 98155 <br><a href="javascript:void(0);">Get Directions</a></p>
														<ul>
															<li>
																<a href="{{ asset('newpanel/assets/img/features/feature-01.jpg') }}" data-fancybox="gallery2">
																	<img src="{{ asset('newpanel/assets/img/features/feature-01.jpg') }}" alt="Feature Image">
																</a>
															</li>
															<li>
																<a href="{{ asset('newpanel/assets/img/features/feature-02.jpg') }}" data-fancybox="gallery2">
																	<img src="{{ asset('newpanel/assets/img/features/feature-02.jpg') }}" alt="Feature Image">
																</a>
															</li>
															<li>
																<a href="{{ asset('newpanel/assets/img/features/feature-03.jpg') }}" data-fancybox="gallery2">
																	<img src="{{ asset('newpanel/assets/img/features/feature-03.jpg') }}" alt="Feature Image">
																</a>
															</li>
															<li>
																<a href="{{ asset('newpanel/assets/img/features/feature-04.jpg') }}" data-fancybox="gallery2">
																	<img src="{{ asset('newpanel/assets/img/features/feature-04.jpg') }}" alt="Feature Image">
																</a>
															</li>
														</ul>
													</div>

												</div>
											</div>
											<!-- /Clinic Content -->
											
											<!-- Clinic Timing -->
											<div class="col-md-4">
												<div class="clinic-timing">
													<div>
														<p class="timings-days">
															<span> Tue - Fri </span>
														</p>
														<p class="timings-times">
															<span>11:00 AM - 1:00 PM</span>
															<span>6:00 PM - 11:00 PM</span>
														</p>
													</div>
													<div>
														<p class="timings-days">
															<span>Sat - Sun</span>
														</p>
														<p class="timings-times">
															<span>8:00 AM - 10:00 AM</span>
															<span>3:00 PM - 7:00 PM</span>
														</p>
													</div>
												</div>
											</div>
											<!-- /Clinic Timing -->
											
											<div class="col-md-2">
												<div class="consult-price">
													$350
												</div>
											</div>
										</div>
									</div>
									<!-- /Location List -->

								</div>
								<!-- /Locations Content -->
								 --}}
                    <!-- Reviews Content -->
                    <div role="tabpanel" id="doc_reviews" class="tab-pane fade">

                        <!-- Review Listing -->
                        <div class="widget review-listing">
                            <ul class="comments-list">
                                @if (count($engr->comment) > 0)
                                    <!-- Comment List -->
                                    @foreach ($engr->comment as $cmt)
                                        <li>
                                            <div class="comment">
                                                <img class="avatar avatar-sm rounded-circle" alt="User Image"
                                                    src="{{ asset('engrphoto/' . Auth::user()->pic) }}">
                                                <div class="comment-body" style="width:100%">
                                                    <div class="meta-data">
                                                        <span class="comment-author">{{ Auth::user()->fname }}</span>
                                                        <span class="comment-date">{{ $cmt['created_at'] }}</span>
                                                        <div class="review-count rating">
                                                            @php
                                                                $service_r = $cmt['service'];
                                                                $t_star = 5;
                                                                $r_star = $t_star - $service_r;
                                                            @endphp
                                                            @for ($i = 0; $i < $service_r; $i++)
                                                                <i class="fas fa-star filled"></i>
                                                            @endfor
                                                            @for ($k = 0; $k < $r_star; $k++)
                                                                <i class="fas fa-star"></i>
                                                            @endfor

                                                            {{-- <i class="fas fa-star filled"></i>
																<i class="fas fa-star filled"></i>
																<i class="fas fa-star filled"></i>
																<i class="fas fa-star"></i> --}}
                                                        </div>
                                                    </div>

                                                    <p class="comment-content">
                                                        {{ $cmt['comment'] }}
                                                    </p>
                                                    {{-- <div class="comment-reply">
															<a class="comment-btn" href="#">
																<i class="fas fa-reply"></i> Reply
															</a>
														   <p class="recommend-btn">
															<span>Recommend?</span>
															<a href="#" class="like-btn">
																<i class="far fa-thumbs-up"></i> Yes
															</a>
															<a href="#" class="dislike-btn">
																<i class="far fa-thumbs-down"></i> No
															</a>
														</p>
														</div> --}}
                                                </div>
                                            </div>

                                            <!-- Comment Reply -->
                                            <ul class="comments-reply">
                                                <li>

                                                    <div class="comment">
                                                        <img class="avatar avatar-sm rounded-circle" alt="User Image"
                                                            src="{{ asset('engrphoto/' . getuser($cmt['engrid'])->pic) }}">
                                                        <div class="comment-body" style="width:100%">
                                                            <div class="meta-data">
                                                                <span
                                                                    class="comment-author">{{ getuser($cmt['engrid'])->fname }}</span>
                                                                <span
                                                                    class="comment-date">{{ $cmt['repliesdate'] }}</span>
                                                                {{-- <div class="review-count rating">
																		<i class="fas fa-star filled"></i>
																		<i class="fas fa-star filled"></i>
																		<i class="fas fa-star filled"></i>
																		<i class="fas fa-star filled"></i>
																		<i class="fas fa-star"></i>
																	</div> --}}
                                                            </div>
                                                            @if ($cmt['replies'] != null && $cmt['replies'] != '')
                                                                <p class="comment-content">
                                                                    {{ $cmt['replies'] }}
                                                                </p>
                                                                {{-- <div class="comment-reply">
																	<a class="comment-btn" href="#">
																		<i class="fas fa-reply"></i> Reply
																	</a>
																	<p class="recommend-btn">
																		<span>Recommend?</span>
																		<a href="#" class="like-btn">
																			<i class="far fa-thumbs-up"></i> Yes
																		</a>
																		<a href="#" class="dislike-btn">
																			<i class="far fa-thumbs-down"></i> No
																		</a>
																	</p>
																</div> --}}
                                                            @else
                                                                No Replies!!
                                                            @endif
                                                        </div>
                                                    </div>

                                                </li>
                                            </ul>
                                            <!-- /Comment Reply -->

                                        </li>
                                    @endforeach

                                    <!-- /Comment List -->
                                @else
                                    No Comment Found!!
                                @endif
                            </ul>



                        </div>
                        <!-- /Review Listing -->

                        <!-- Write Review -->
                        <div class="write-review">

                            <h4>Write a review for <strong>{{ Auth::user()->fname . ' ' . Auth::user()->lname }}</strong>
                            </h4>

                            <!-- Write Review Form -->
                            <form method="post" action="{{ route('commentmessage') }}">
                                @csrf
                                <input type="hidden" value="{{ $engr->id }}" name="engr_id">
                                <div class="form-group">
                                    <label>Services Rating</label>
                                    <div class="star-rating">
                                        <input id="star-5" type="radio" name="rating" value="5">
                                        <label for="star-5" title="5 stars">
                                            <i class="active fa fa-star"></i>
                                        </label>
                                        <input id="star-4" type="radio" name="rating" value="4">
                                        <label for="star-4" title="4 stars">
                                            <i class="active fa fa-star"></i>
                                        </label>
                                        <input id="star-3" type="radio" name="rating" value="3">
                                        <label for="star-3" title="3 stars">
                                            <i class="active fa fa-star"></i>
                                        </label>
                                        <input id="star-2" type="radio" name="rating" value="2">
                                        <label for="star-2" title="2 stars">
                                            <i class="active fa fa-star"></i>
                                        </label>
                                        <input id="star-1" type="radio" name="rating" value="1">
                                        <label for="star-1" title="1 star">
                                            <i class="active fa fa-star"></i>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Response Rating</label>
                                    <div class="star-rating">
                                        <input id="res-5" type="radio" name="responserating" value="5">
                                        <label for="res-5" title="5 stars">
                                            <i class="active fa fa-star"></i>
                                        </label>
                                        <input id="res-4" type="radio" name="responserating" value="4">
                                        <label for="res-4" title="4 stars">
                                            <i class="active fa fa-star"></i>
                                        </label>
                                        <input id="res-3" type="radio" name="responserating" value="3">
                                        <label for="res-3" title="3 stars">
                                            <i class="active fa fa-star"></i>
                                        </label>
                                        <input id="res-2" type="radio" name="responserating" value="2">
                                        <label for="res-2" title="2 stars">
                                            <i class="active fa fa-star"></i>
                                        </label>
                                        <input id="res-1" type="radio" name="responserating" value="1">
                                        <label for="res-1" title="1 star">
                                            <i class="active fa fa-star"></i>
                                        </label>
                                    </div>
                                </div>
                                {{-- <div class="form-group">
												<label>Title of your review</label>
												<input class="form-control" type="text" placeholder="If you could say it in one sentence, what would you say?">
											</div> --}}
                                <div class="form-group">
                                    <label>Your review</label>
                                    <textarea id="review_desc" name="msg_cmt" maxlength="100" class="form-control" required></textarea>

                                    {{-- <div class="d-flex justify-content-between mt-3"><small class="text-muted"><span id="chars">100</span> characters remaining</small></div> --}}
                                </div>
                                <hr>
                                {{-- <div class="form-group">
												<div class="terms-accept">
													<div class="custom-checkbox">
													   <input type="checkbox" id="terms_accept">
													   <label for="terms_accept">I have read and accept <a href="#">Terms &amp; Conditions</a></label>
													</div>
												</div>
											</div> --}}
                                <div class="submit-section">
                                    <button type="submit" class="btn btn-primary submit-btn">Add Review</button>
                                </div>
                            </form>
                            <!-- /Write Review Form -->

                        </div>
                        <!-- /Write Review -->

                    </div>
                    <!-- /Reviews Content -->

                    <!-- Business Hours Content -->

                    {{-- <div role="tabpanel" id="doc_business_hours" class="tab-pane fade">
									<div class="row">
										<div class="col-md-6 offset-md-3">
											
											<!-- Business Hours Widget -->
											<div class="widget business-widget">
												<div class="widget-content">
													<div class="listing-hours">
														<div class="listing-day current">
															<div class="day">Today <span>5 Nov 2019</span></div>
															<div class="time-items">
																<span class="open-status"><span class="badge bg-success-light">Open Now</span></span>
																<span class="time">07:00 AM - 09:00 PM</span>
															</div>
														</div>
														<div class="listing-day">
															<div class="day">Monday</div>
															<div class="time-items">
																<span class="time">07:00 AM - 09:00 PM</span>
															</div>
														</div>
														<div class="listing-day">
															<div class="day">Tuesday</div>
															<div class="time-items">
																<span class="time">07:00 AM - 09:00 PM</span>
															</div>
														</div>
														<div class="listing-day">
															<div class="day">Wednesday</div>
															<div class="time-items">
																<span class="time">07:00 AM - 09:00 PM</span>
															</div>
														</div>
														<div class="listing-day">
															<div class="day">Thursday</div>
															<div class="time-items">
																<span class="time">07:00 AM - 09:00 PM</span>
															</div>
														</div>
														<div class="listing-day">
															<div class="day">Friday</div>
															<div class="time-items">
																<span class="time">07:00 AM - 09:00 PM</span>
															</div>
														</div>
														<div class="listing-day">
															<div class="day">Saturday</div>
															<div class="time-items">
																<span class="time">07:00 AM - 09:00 PM</span>
															</div>
														</div>
														<div class="listing-day closed">
															<div class="day">Sunday</div>
															<div class="time-items">
																<span class="time"><span class="badge bg-danger-light">Closed</span></span>
															</div>
														</div>
													</div> 
													<div>
														<form method="post" action="{{ route('commentmessage')}}">
															@csrf
															<input type="text" value="{{ $engr->id }}" name="engr_id" hidden>
															<input type="text" value="commentsession" name="comment_sess" hidden>
															<label for="msg_cmt" style="font-style:bold;font-size:18px">Comments</label>
															<textarea class="form-control rounded-2" name="msg_cmt" id="msg_cmt" cols="5" rows="5" placeholder="Enter Your Comments Here"></textarea>
															<button class="btn btn-small btn-primary mt-2 px-5">Save</button>
														</form>
													</div>
												</div>
											</div>
											<!-- /Business Hours Widget -->
									
										</div>
									</div>
								</div> --}}

                    <!-- /Business Hours Content -->

                </div>
            </div>
        </div>
        <!-- /Doctor Details Tab -->

    </div>
</div>
<!-- /Page Content -->


</div>
<!-- /Main Wrapper -->




@push('childscript')
    <script src="{{ asset('inteltelphone/js/intlTelInput.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- <script type="text/javascript" src="/js/bootstrap.js"></script> --}}
    <script>
        $(document).ready(function() {
            var input = document.querySelector("#mobile");
            intlTelInput(input, {
                initialCountry: "auto",
                geoIpLookup: function(success, failure) {
                    $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                        var countryCode = (resp && resp.country) ? resp.country : "";
                        success(countryCode);
                    });
                },
                utilsScript: "{{ asset('inteltelphone/js/utils.js') }}",
            });
            $('.customchatbox').hide();



        });

        function clientchat_box(engrid, clientid, engr_name, engr_img, engr_status) {

            $('.customchatbox').hide('slow');
            var clientid = '{{ Auth::check() ? Auth::user()->id : 'not login' }}';
            if (clientid == "not login") {
                window.location.href = "{{ URL::to('login') }}";
            } else {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ URL::to('onegetchatmsg') }}",
                    method: 'post',
                    data: {
                        senderid: clientid,
                        reciverid: engrid
                    },
                    success: function(data) {
                        $('#picofreciver').attr('src', engr_img);
                        $('#name_engineer').text(engr_name);
                        $('.showonline_status_engr').css('color', engr_status)
                        $('.customchatbox').show('slow');
                        $('.customchatbox').attr('id', 'clientengr' + engrid + clientid);
                        const innerDiv = document
                            .getElementById('chatbody' + clientid)
                            .querySelector('#chatbox' + engrid);
                        if (innerDiv != null) {
                            $('#chatbox' + engrid).html('');
                            var index_msgs = 0;
                            var date_msg_check = '';
                            $.each(data, function(res, value) {
                                console.log(value);
                                if (index_msgs == 0) {
                                    let date_div =
                                        `<div style="text-align: center;margin: 0px auto;width: 30%;background-color: #a6afa6;padding: 4px 0px;border-radius: 4px;font-size: 14px;font-weight: bold;"><span>${value.created_at}</span></div>`;
                                    date_msg_check = value.created_at;
                                    $('#chatbox' + engrid).append(date_div);
                                } else {

                                    if (value.created_at == date_msg_check) {

                                    } else {
                                        let date_div =
                                            `<div style="text-align: center;margin: 0px auto;width: 30%;background-color: #a6afa6;padding: 4px 0px;border-radius: 4px;font-size: 14px;font-weight: bold;"><span>${value.created_at}</span></div>`;
                                        date_msg_check = value.created_at;
                                        $('#chatbox' + engrid).append(date_div);
                                    }
                                    if (value.senderid == clientid) {
                                        var app_s =

                                            "<div class='outgoing'>" +
                                            "<span style='font-size:12px'> " + value.updated_at +
                                            "</span>" +
                                            "<br>" +
                                            "<div class='bubble'>" +
                                            "<p>" + value.message + "</p>" +

                                            "</div>" +
                                            "</div>";
                                    } else {
                                        var app_s =
                                            "<div class='incoming'>" +
                                            "<span style='font-size:12px'> " + value.updated_at +
                                            "</span>" +
                                            "<br>" +
                                            "<div class='bubble'>" +
                                            "<p>" + value.message + "</p>" +
                                            "</div>" +
                                            "</div>";
                                    }


                                    $('#chatbox' + engrid).append(app_s);


                                }
                                index_msgs++;
                            });
                        } else {
                            alert("Not reciver online");
                        }

                    }
                });
            }



        }

        function closeclientchatbox() {
            $('.customchatbox').hide('slow');
        }

        function shoemodeldate() {
            event.preventDefault();
            $('#orderdetail_modal').appendTo('body').modal('show');

        }

        function showmodelvideo() {
            event.preventDefault();
            $('#videoconsultant_modal').appendTo('body').modal('show');
        }

        setInterval(() => {
            let engr_profile = $('#engineer_id_status').val();



            $.ajax({
                url: '{{ url('onlineenge_arr') }}',
                type: 'post',
                data: {
                    engr_arr: engr_profile
                },
                success: function(data) {
					if(data == 'yes'){
						$('.showonline_status').css('color','#5bc155')
						$('.showonline_status_engr').css('color','#5bc155')
					}else{
						$('.showonline_status').css('color','#f13535')
						$('.showonline_status_engr').css('color','#f13535')
					}
                }
            });



        }, 5000);
    </script>
@endpush
