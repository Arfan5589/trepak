			<!-- Breadcrumb -->
			<div class="breadcrumb-bar topsection">
				<div class="container-fluid">
					<div class="row align-items-center">
						<div class="col-md-12 col-12">
							<nav aria-label="breadcrumb" class="page-breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Checkout</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Checkout</h2>
						</div>
					</div>
				</div>
			</div>
			<!-- /Breadcrumb -->
			
			<!-- Page Content -->
			<div class="content">
				<div class="container">

					<div class="row">
						<div class="col-md-5 col-lg-4 theiaStickySidebar">
						
							<!-- Booking Summary -->
							<div class="card booking-card">
								<div class="card-header">
									<h4 class="card-title">Booking Summary</h4>
								</div>
								<div class="card-body">
									
									
							
									<!-- Booking Doctor Info -->
									<div class="booking-doc-info">
										@php
											if($engr->signupoption == 1){
												$engrimg = $engr->pic; 
											}else{
												$engrimg = asset('engrphoto/'.$engr->pic);
											}
										@endphp
										<a href="#" class="booking-doc-img">
											<img src="{{ $engrimg }}" alt="User Image">
										</a>
										<div class="booking-info">
											<h4><a href="#">{{ $engr->fname }}</a></h4>
											<div class="rating">
												<i class="fas fa-star filled"></i>
												<i class="fas fa-star filled"></i>
												<i class="fas fa-star filled"></i>
												<i class="fas fa-star filled"></i>
												<i class="fas fa-star"></i>
												<span class="d-inline-block average-rating">35</span>
											</div>
											<div class="clinic-details">
												<p class="doc-location"><i class="fas fa-map-marker-alt"></i> {{ $engr->city .', '.$engr->country }}</p>
											</div>
										</div>
									</div>
									<!-- Booking Doctor Info -->
									
									<div class="booking-summary">
										<div class="booking-item-wrap">
											<ul class="booking-date">
												
												<li>Date <span>{{ $meetingdate }}</span></li>
												<li>Time <span>{{ $meetingtime }}</span></li>
												
											</ul>
											<ul class="booking-fee">
												
												
												<li >Consulting Fee <span class="amount">$20</span></li>
												<li >Booking Fee <span class="amount">$10</span></li>
												
											</ul>
											<div class="booking-total">
												<ul class="booking-total-list">
													<li>
														<span>Total</span>
														
														<span><span class="total-cost"></span></span>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</form>
								</div>
							</div>
							@php
								
								
							@endphp
							
							<!-- /Booking Summary -->
							
						</div>
						<div class="col-md-7 col-lg-8">
							<div class="card">
								<div class="card-body">
								
									<!-- Checkout Form -->
									<form action="{{ route('conformorder') }}" method="post">
									@csrf
									<input type="text" name="engr_id" value="{{ $engr->id }}" hidden>
									<input type="text" name="totalfee" id="totalfee" hidden>
									<input type="text" name="engrdate" value="{{ $meetingdate }}" hidden>
									<input type="text" name="consultingfee" value=20  hidden >
									<input type="text" name="bookingfee" id="bookingfee"  hidden>
									{{-- <input type="text" name="paymentmethod" id="paymentmethod" hidden> --}}
										<!-- Personal Information -->
										<div class="info-widget">
											<h4 class="card-title">Personal Information</h4>
											<div class="row">
												<div class="col-md-6 col-sm-12">
													<div class="form-group card-label">
														<label>First Name</label>
														<input class="form-control" type="text" style="background-color:white;" readonly value="{{ Auth::user()->fname }}">
													</div>
												</div>
												<div class="col-md-6 col-sm-12">
													<div class="form-group card-label">
														<label>Last Name</label>
														<input class="form-control" type="text" style="background-color:white;" readonly value="{{ Auth::user()->lname }}">
													</div>
												</div>
												<div class="col-md-6 col-sm-12">
													<div class="form-group card-label">
														<label>Email</label>
														<input class="form-control" type="email" style="background-color:white;" readonly value="{{ Auth::user()->email }}">
													</div>
												</div>
												<div class="col-md-6 col-sm-12">
													<div class="form-group card-label">
														<label>Phone</label>
														<input class="form-control" type="text" style="background-color:white;" readonly value="{{ Auth::user()->mobile }}">
													</div>
												</div>
											</div>
											
										</div>
										<!-- /Personal Information -->
										
										<div class="payment-widget">
											<h4 class="card-title">Payment Method</h4>
											<!-- Paypal Payment -->
											<div class="payment-list">
												<label class="payment-radio paypal-option">
													<input type="radio" name="payment_radio" id="cash_delivery" checked value="cashondelivery">
													<span class="checkmark"></span>
													Cash On Delivery
												</label>
											</div>
											<!-- /Paypal Payment -->
											<!-- Credit Card Payment -->
											<div class="payment-list">
												<label class="payment-radio credit-card-option">
													<input type="radio" id="card_payment" name="payment_radio"  value="cardpayment">
													<span class="checkmark"></span>
													Credit card
												</label>
												<div id="cardpaymentdiv">
												<div class="row" >
													<div class="col-md-6">
														<div class="form-group card-label">
															<label for="card_name">Name on Card</label>
															<input class="form-control" id="card_name" name="card_name" type="text" value="card payment">
														</div>
													</div>
													<div class="col-md-6" >
														<div class="form-group card-label">
															<label for="card_number">Card Number</label>
															<input class="form-control" id="card_number" placeholder="1234  5678  9876  5432" type="text">
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group card-label">
															<label for="expiry_month">Expiry Month</label>
															<input class="form-control" id="expiry_month" placeholder="MM" type="text">
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group card-label">
															<label for="expiry_year">Expiry Year</label>
															<input class="form-control" id="expiry_year" placeholder="YY" type="text" value="{{ session()->get('engrid') }}">
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group card-label">
															<label for="cvv">CVV</label>
															<input class="form-control" id="cvv" type="text">
														</div>
													</div>
												</div>
												</div>
											</div>
											<!-- /Credit Card Payment -->
											
											<!-- Paypal Payment -->
											<div class="payment-list">
												<label class="payment-radio paypal-option">
													<input type="radio" id="paypal" name="payment_radio" value="paypal">
													<span class="checkmark"></span>
													Paypal
												</label>
											</div>
											<!-- /Paypal Payment -->

											
											
											<!-- Terms Accept -->
											<div class="terms-accept">
												<div class="custom-checkbox">
												   <input type="checkbox" id="terms_accept">
												   <label for="terms_accept">I have read and accept <a href="#">Terms &amp; Conditions</a></label>
												</div>
											</div>
											<!-- /Terms Accept -->
											
											<!-- Submit Section -->
											<div class="submit-section mt-4">
												<button type="submit" class="btn btn-primary submit-btn">Confirm and Pay</button>
											</div>
											<!-- /Submit Section -->
											
										</div>
									
									<!-- /Checkout Form -->
									
								</div>
							</div>
							
						</div>
						
						
					</div>

				</div>

			</div>	
			@php
				if(session()->has('select_date')){
					session()->forget('select_date');
					session()->forget('engr_id');
				}
			@endphp	
			<!-- /Page Content -->
			@push('childscript')
			<script>
				$(document).ready(function(){
					var paymentbtn_value = $("input[name=payment_radio]:checked").val();
					if(paymentbtn_value != 'cardpayment'){
						$('#cardpaymentdiv').hide();
						// $('#paymentmethod').val('');
						// $('#paymentmethod').val('cashondelivery');
					}
				$("input[name=payment_radio]").on('change',function () {
					if($(this).val()== 'cashondelivery'){
						$('#cardpaymentdiv').hide('swing');
						// $('#paymentmethod').val('');
						// $('#paymentmethod').val('cashondelivery');
					}else if($(this).val()== 'cardpayment'){
						$('#cardpaymentdiv').show('swing');
						// $('#paymentmethod').val('');
						// $('#paymentmethod').val('cardpayment');
					}else{
						$('#cardpaymentdiv').hide('swing');
						// $('#paymentmethod').val('');
						// $('#paymentmethod').val('paypal');
					}
					
               });
			   var amout_field =  $('.amount');
				var i = 0;
				var total = 0;
				for(i;i<amout_field.length;i++){
					
					let bill = $(amout_field[i]).text();
					 let count =bill.length;
					let bill_amount = bill.substr(1,count);
					if(i == 1){
						$('#bookingfee').val(bill_amount);
					}
					total += bill_amount*1;
				}

				$('.total-cost').text('$'+total);
				$('#totalfee').val(total);
    
				});
				
			</script>
				
			@endpush