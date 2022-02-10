
@extends('layouts.app')
@section('header')
<header class="page-header">
						<h2>User Profile</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.html">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>User Profile</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>
                    @endsection
@section('content')
		

					<!-- start: page -->

					<div class="row">
						<div class="col-md-4 col-lg-3">

							<section class="panel">
								<div class="panel-body">
									<div class="thumb-info mb-md">
										<img   src="{{ Gravatar::src(Auth::user()->email) }}" class="rounded img-responsive" alt="John Doe">
										<div class="thumb-info-title">
											<span class="thumb-info-inner">{{ Auth::user()->name }}</span>
											<span class="thumb-info-type">CEO</span>
										</div>
									</div>

									<div class="widget-toggle-expand mb-md">
										<div class="widget-header">
											<h6>Profile Completion</h6>
											<div class="widget-toggle">+</div>
										</div>
										<div class="widget-content-collapsed">
											<div class="progress progress-xs light">
												<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
													60%
												</div>
											</div>
										</div>
										<div class="widget-content-expanded">
											<ul class="simple-todo-list">
												<li class="@if(Auth::user()->avatar !=null) completed  @endif">Update Profile Picture</li>
												<li class="@if(Auth::user()->name !=null) completed  @endif">Change Personal Information</li>
												<li>Update Social Media</li>
												<li class="@if(Auth::user()->email_verified_at !=null) completed  @endif">Email Verified</li>
											</ul>
										</div>
									</div>

									<hr class="dotted short">

									<h6 class="text-muted">About</h6>
									<p>{{ $auth_user->about}}</p>
				
									<hr class="dotted short">

									<div class="social-icons-list">
										<a rel="tooltip" data-placement="bottom" target="_blank" href="http://www.facebook.com" data-original-title="Facebook"><i class="fa fa-facebook"></i><span>Facebook</span></a>
										<a rel="tooltip" data-placement="bottom" href="http://www.twitter.com" data-original-title="Twitter"><i class="fa fa-twitter"></i><span>Twitter</span></a>
										<a rel="tooltip" data-placement="bottom" href="http://www.linkedin.com" data-original-title="Linkedin"><i class="fa fa-linkedin"></i><span>Linkedin</span></a>
									</div>

								</div>
							</section>


							<section class="panel">
								<header class="panel-heading">
									<div class="panel-actions">
										<a href="#" class="fa fa-caret-down"></a>
										<a href="#" class="fa fa-times"></a>
									</div>

									<h2 class="panel-title">Popular Posts</h2>
								</header>
								<div class="panel-body">
									<ul class="simple-post-list">
										@foreach(Auth::user()->discussion()->get() as $userdiscussions)
										<li>
										
											<div class="post-info">
												<a href="{{route('discussions.show',$userdiscussions->slug)}}">{{$userdiscussions->title}}</a>
												<div class="post-meta">
												{{$userdiscussions->created_at->diffForHumans()}}
												</div>
											</div>
										</li>
										@endforeach
									
									</ul>
								</div>
							</section>

						</div>
						<div class="col-md-8 col-lg-6">

							<div class="tabs">
								<ul class="nav nav-tabs tabs-primary">
									<li class="active">
										<a href="#overview" data-toggle="tab">Overview</a>
									</li>
									<li>
										<a href="#edit" data-toggle="tab">Edit</a>
									</li>
								</ul>
								<div class="tab-content">
									<div id="overview" class="tab-pane active">
										<h4 class="mb-md">Update Status</h4>

										<section class="simple-compose-box mb-xlg">
											<form method="get" action="/">
												<textarea name="message-text" data-plugin-textarea-autosize placeholder="What's on your mind?" rows="1"></textarea>
											</form>
											<div class="compose-box-footer">
												<ul class="compose-toolbar">
													<li>
														<a href="#"><i class="fa fa-camera"></i></a>
													</li>
													<li>
														<a href="#"><i class="fa fa-map-marker"></i></a>
													</li>
												</ul>
												<ul class="compose-btn">
													<li>
														<a class="btn btn-primary btn-xs">Post</a>
													</li>
												</ul>
											</div>
										</section>

										<h4 class="mb-xlg">Timeline</h4>

										<div class="timeline timeline-simple mt-xlg mb-md">
											<div class="tm-body">
												<div class="tm-title">
													<h3 class="h5 text-uppercase"> {{  Carbon\Carbon::now()->format('F Y')  }}</h3>
												</div>
												<ol class="tm-items">
													@foreach($actions as $act)

													@if($act->type =='Status')

													<li>
														<div class="tm-box">
															<p class="text-muted mb-none">{{$act->created_at->diffForHumans()}}..</p>
															<p>
															{{$act->action}}	

															</p>
															<div class="thumbnail-gallery">
																<a class="img-thumbnail lightbox" href="assets/images/projects/project-4.jpg" data-plugin-options='{ "type":"image" }'>
																	<img class="img-responsive" width="215" src="assets/images/projects/project-4.jpg">
																	<span class="zoom">
																		<i class="fa fa-search"></i>
																	</span>
																</a>
															</div>
														</div>
													</li>
										
													@else
													<li>
														<div class="tm-box">
															<p class="text-muted mb-none">{{$act->created_at->diffForHumans()}}.</p>
															<p>
														{{$act->action}}	
															</p>
														</div>
													</li>
													@endif
													@endforeach
												</ol>
											</div>
										</div>
									</div>
									<div id="edit" class="tab-pane">

										<form class="form-horizontal" method="get">
											<h4 class="mb-xlg">Personal Information</h4>
											<fieldset>
												<div class="form-group">
													<label class="col-md-3 control-label" for="profileFirstName">First Name</label>
													<div class="col-md-8">
														<input type="text" class="form-control" id="profileFirstName" name="name" value="{{$auth_user->name}}">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" for="profileEamil" >Email Address</label>
													<div class="col-md-8">
														<input type="text" class="form-control" id="profileEamil" name="email" value="{{$auth_user->email}}">
													</div>
												</div>
									
										
											</fieldset>
											<hr class="dotted tall">
											<h4 class="mb-xlg">About Yourself</h4>
											<fieldset>
												<div class="form-group">
													<label class="col-md-3 control-label" for="profileBio">Biographical Info</label>
													<div class="col-md-8">
														<textarea class="form-control" rows="3"  name="about" id="profileBio"> {{$auth_user->about}}</textarea>
													</div>
												</div>
												<div class="form-group">
													<label class="col-xs-3 control-label mt-xs pt-none">Public</label> 
													<div class="col-md-8">
														<div class="checkbox-custom checkbox-default checkbox-inline mt-xs">
															<input type="checkbox" checked="" id="profilePublic">
															<label for="profilePublic"></label>
														</div>
													</div>
												</div>
											</fieldset>
											<hr class="dotted tall">
											<h4 class="mb-xlg">Change Password</h4>
											<fieldset class="mb-xl">
												<div class="form-group">
													<label class="col-md-3 control-label" for="profileNewPassword">New Password</label>
													<div class="col-md-8">
														<input type="text" class="form-control" id="profileNewPassword">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" for="profileNewPasswordRepeat">Repeat New Password</label>
													<div class="col-md-8">
														<input type="text" class="form-control" id="profileNewPasswordRepeat">
													</div>
												</div>
											</fieldset>
											<div class="panel-footer">
												<div class="row">
													<div class="col-md-9 col-md-offset-3">
														<button type="submit" class="btn btn-primary">Submit</button>
														<button type="reset" class="btn btn-default">Reset</button>
													</div>
												</div>
											</div>

										</form>

									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12 col-lg-3">

							<h4 class="mb-md">Sale Stats</h4>
							<ul class="simple-card-list mb-xlg">
								<li class="primary">
									<h3>{{ Auth::user()->point }}</h3>
									<p>points.</p>
								</li>
								<li class="primary">
									<h3>{{Auth::user()->discussion()->count()}}</h3>
									<p>number of discussions.</p>
								</li>
							
							</ul>

							<h4 class="mb-md"> User Channels</h4>
							<ul class="simple-bullet-list mb-xlg">
								@foreach(Auth::user()->discussion()->get() as $userdiscussions)
								<li class="red">
									<span class="title">{{ $userdiscussions->channel->name}}</span>
									<!-- todo hta nziido ->distinct() -->
								</li>
								@endforeach
						
							</ul>

						</div>

					</div>
					<!-- end: page -->
                @endsection
