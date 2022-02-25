@extends('layouts.admin-app')
@section('content')



    @if (isset($setting))
        <form action="{{ route('setting.update', $setting) }}" method="post" enctype="multipart/form-data">
            {{ method_field('PATCH') }}
        @else
            <form action="{{ route('setting.store') }}" method="post" enctype="multipart/form-data">
    @endif
    @csrf
    <div class="row">
        <div class="col-md-8">
            <div class="card card-default card-top">
                <div class="card-header">
                    <h3 class="card-title">Details: </h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="display: block;">
                    <div class="form-group">
                        <label>App Name:</label>
                        <input type="text" name="name" class="form-control form-control-sm"
                            placeholder="Enter Your App Name" value="{{ old('name', @$setting->name) }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Icon:</label><br>
                                <label>
                                    <img src="@if (!$setting->icon == '') {{ asset('uploads/setting/thumbnail/' . $setting->icon) }} @else {{ asset('placeholder.png') }} @endif" id="iconThumbnail" height="100" width="150">
                                    <input type="file" name="icon" hidden="hidden" id="icon">
                                </label>
                                @error('icon')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Logo:</label><br>
                                <label>
                                    <img src="@if (!$setting->logo == '') {{ asset('uploads/setting/thumbnail/' . $setting->logo) }} @else {{ asset('placeholder.png') }} @endif" id="logoThumbnail" height="100" width="150">
                                    <input type="file" name="logo" hidden="hidden" id="logo">
                                </label>
                                @error('logo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="close-day">Close Day:</label>
                                <select class="form-control form-control-sm" name="close_day">
                                    @if(isset($setting))
                                    <option value="{{$setting->close_day}}">{{$setting->close_day}}</option>
                                    @endif
                                    <option value="Sunday">Sunday</option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                </select>
                                @error('close_day')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="close-day">Opening Time:</label>
                                <input type="time" class="form-control form-control-sm" value="{{ old('open_time', @$setting->open_time) }}" name="open_time">
                                @error('open_time')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="close-day">Closing Time:</label>
                                <input type="time" class="form-control form-control-sm" value="{{ old('close_time', @$setting->close_time) }}" name="close_time">
                                @error('close_time')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" name="email" class="form-control form-control-sm"
                            placeholder="Enter Email Address" value="{{ old('email', @$setting->email) }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control form-control-sm" placeholder="Enter Address"
                            value="{{ old('address', @$setting->address) }}">
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Contact No:</label>
                        <input type="text" name="contact_no" class="form-control form-control-sm"
                            placeholder="Enter Contact No" value="{{ old('contact_no', @$setting->contact_no) }}">
                        @error('contact_no')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Location:</label>
                        <input type="text" name="location" class="form-control form-control-sm"
                            placeholder="Enter Location in URL" value="{{ old('location', @$setting->location) }}">
                        @error('location')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card card-default card-top collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">Social Links</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body" style="display: none;">
                    <div class="form-group">
                        <label>Facebook Link:</label>
                        <input type="text" name="facebook_link" class="form-control form-control-sm"
                            placeholder="Enter facebook link in URL"
                            value="{{ old('facebook_link', @$setting->facebook_link) }}">
                        @error('facebook_link')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Twitter Link:</label>
                        <input type="text" name="twitter_link" class="form-control form-control-sm"
                            placeholder="Enter Twitter Link in URL"
                            value="{{ old('twitter_link', @$setting->twitter_link) }}">
                        @error('twitter_link')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Instagram Link:</label>
                        <input type="text" name="insta_link" class="form-control form-control-sm"
                            placeholder="Enter Google Link in URL"
                            value="{{ old('insta_link', @$setting->insta_link) }}">
                        @error('insta_link')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Youtube Link:</label>
                        <input type="text" name="youtube_link" class="form-control form-control-sm"
                            placeholder="Enter Youtube Link in URL"
                            value="{{ old('youtube_link', @$setting->youtube_link) }}">
                        @error('youtube_link')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Linkedin Link:</label>
                        <input type="text" name="linkedin_link" class="form-control form-control-sm"
                            placeholder="Enter Linkedin Link in URL"
                            value="{{ old('linkedin_link', @$setting->linkedin_link) }}">
                        @error('linkedin_link')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Whats App No:</label>
                        <input type="number" name="whatsapp_no" class="form-control form-control-sm"
                            placeholder="Enter Linkedin Link in URL"
                            value="{{ old('whatsapp_no', @$setting->whatsapp_no) }}">
                        @error('whatsapp_no')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Viber App No:</label>
                        <input type="number" name="viber_no" class="form-control form-control-sm"
                            placeholder="Enter Linkedin Link in URL" value="{{ old('viber_no', @$setting->viber_no) }}">
                        @error('viber_no')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-default card-top collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">SEO</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="card-body" style="display: none;">
                    <div class="form-group">
                        <label for="title">Meta Title:</label>
                        <input type="text" class="form-control form-control-sm"
                            value="{{ old('title_tag', @$setting->title_tag) }}" name="title_tag">
                        @error('title_tag')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="title">Meta Keywords:</label>
                        <textarea name="meta_keywords" id="meta_keywords" rows="3"
                            class="form-control">{{ old('met_keywords', @$setting->meta_keywords) }}</textarea>
                        @error('meta_keywords')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="title">Meta Description:</label>
                        <textarea name="meta_description" id="meta_description" rows="3"
                            class="form-control">{{ old('meta_description', @$setting->meta_description) }}</textarea>
                        @error('meta_description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>


            <div class="card card-default card-top collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">Others:</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body" style="display: none;">
                    <div class="form-group">
                        <label for="title">Quotation:</label>
                        <textarea name="quotation" id="quotation" rows="3"
                            class="form-control">{{ old('quotation', @$setting->quotation) }}</textarea>
                        @error('quotation')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>


            <div class="card card-default card-top">
                <div class="card-header">
                    <h3 class="card-title">Action: </h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="display: block;">
                    <button type="submit" class="btn btn-primary float-right">
                        @if (isset($setting))
                            Update
                        @else
                            Save
                        @endif
                    </button>
                </div>
            </div>
        </div>
    </div>
    <form>
    @endsection
    @push('js')
        <script type="text/javascript">
            $('#icon').on('change', function() {
                var file = $(this).get(0).files;
                var reader = new FileReader();
                reader.readAsDataURL(file[0]);
                reader.addEventListener("load", function(e) {
                    var image = e.target.result;
                    $("#iconThumbnail").attr('src', image);
                });
            });
            $('#logo').on('change', function() {
                var file = $(this).get(0).files;
                var reader = new FileReader();
                reader.readAsDataURL(file[0]);
                reader.addEventListener("load", function(e) {
                    var image = e.target.result;
                    $("#logoThumbnail").attr('src', image);
                });
            });
        </script>
    @endpush
