@extends('front.formfiller_dashboard')
@section('content')
      @if(session()->has('success'))
          <div class="alert alert-success" id="hideAlert" style="margin-top: 50px;">
              {{ session()->get('success') }}
          </div>
      @endif
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-8">
              <div class="card">
                @if(\Auth::user()->profile_completed == 'No')
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Dear {{ \Auth::user()->name }}</h4>
                  <p class="card-category">Please first complete your profile then we redirect to your Dashboard.</p>
                </div>
                <div class="card-body">
                  <form method="post" action="{{ url('form-filler/profile/update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Email</label>
                          <input type="text" class="form-control" name="email" value="{{ \Auth::user()->email }}" autocomplete="off" required="" readonly="">
                          @if($errors->has('email'))
                              <span style="color: red;">{{ $errors->first('email') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Contact Number</label>
                          <input type="text" class="form-control" name="contact_number" value="{{ \Auth::user()->contact_number }}" autocomplete="off" required="" readonly="">
                          @if($errors->has('contact_number'))
                              <span style="color: red;">{{ $errors->first('contact_number') }}</span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Name</label>
                          <input type="text" class="form-control" name="name" value="{{ \Auth::user()->name }}" autocomplete="off" required="">
                          @if($errors->has('name'))
                              <span style="color: red;">{{ $errors->first('name') }}</span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Gender</label><br>
                          @if(old('gender') == 'Male')
                            <input class="w3-radio" type="radio" name="gender" value="Male" checked="">
                            <label>Male</label>
                            <input class="w3-radio" type="radio" name="gender" value="Female">
                            <label>Female</label>
                          @elseif(old('gender') == 'Female')
                            <input class="w3-radio" type="radio" name="gender" value="Male">
                            <label>Male</label>
                            <input class="w3-radio" type="radio" name="gender" value="Female" checked="">
                            <label>Female</label>
                          @else 
                            <input class="w3-radio" type="radio" name="gender" value="Male">
                            <label>Male</label>
                            <input class="w3-radio" type="radio" name="gender" value="Female">
                            <label>Female</label>
                          @endif
                          @if($errors->has('gender'))
                              <span style="color: red;">{{ $errors->first('gender') }}</span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Address</label>
                          <input type="text" class="form-control" name="address"  value="{{ \Auth::user()->address }}" autocomplete="off" required="">
                          @if($errors->has('address'))
                              <span style="color: red;">{{ $errors->first('address') }}</span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Father's Name</label>
                          <input type="text" class="form-control" name="f_name" value="{{ old('f_name') }}" autocomplete="off" required="">
                          @if($errors->has('f_name'))
                              <span style="color: red;">{{ $errors->first('f_name') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Mother's Name</label>
                          <input type="text" class="form-control" name="m_name" value="{{ old('m_name') }}" autocomplete="off" required="">
                          @if($errors->has('m_name'))
                              <span style="color: red;">{{ $errors->first('m_name') }}</span>
                          @endif
                        </div>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="">Date Of Birth</label>
                          <input type="date" class="form-control" name="dob" value="{{ old('dob') }}"  required="">
                          @if($errors->has('dob'))
                              <span style="color: red;">{{ $errors->first('dob') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Postal Code</label>
                          <input type="number" class="form-control" name="postal_code" value="{{ old('postal_code') }}" autocomplete="off" required="">
                          @if($errors->has('postal_code'))
                              <span style="color: red;">{{ $errors->first('postal_code') }}</span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">City</label>
                          <select type="text" class="form-control" name="city" required="">
                              <option></option>
                              @foreach($data['city'] as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                              @endforeach
                          </select>
                          @if($errors->has('city'))
                              <span style="color: red;">{{ $errors->first('city') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-6">

                        <div class="form-group">
                          <label class="bmd-label-floating">Select Category</label>
                          <select type="text" class="form-control" name="category" required="">
                              <option></option>
                              @foreach($data['categories'] as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                              @endforeach
                          </select>
                          @if($errors->has('category'))
                              <span style="color: red;">{{ $errors->first('category') }}</span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Licence / Voter id Number</label>
                          <div class="form-group">
                            <input type="text" class="form-control"name="l_v_id" value="{{ old('l_v_id') }}" autocomplete="off" required="">
                            @if($errors->has('l_v_id'))
                              <span style="color: red;">{{ $errors->first('l_v_id') }}</span>
                            @endif
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Aadhaar Number</label>
                          <div class="form-group">
                            <input type="text" class="form-control" name="aadhaar" value="{{ old('aadhaar') }}" autocomplete="off" required="">
                            @if($errors->has('aadhaar'))
                              <span style="color: red;">{{ $errors->first('aadhaar') }}</span>
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Upload Aadhaar (Front Side)</label>
                          <input type='file' name="aadhaar_front" onchange="readURL(this);" required="">
                          <img id="aadhaar1"  src="#" alt="your image" style="margin-top: 10px;" />
                          @if($errors->has('aadhaar_front'))
                              <span style="color: red;">{{ $errors->first('aadhaar_front') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <div class="form-group">
                          <label>Upload Aadhaar (Back Side)</label>
                          <input type='file' name="aadhaar_back" onchange="readURLNew(this);" required="">
                          <img id="aadhaar2"  src="#" alt="your image" style="margin-top: 10px;" />
                          @if($errors->has('aadhaar_back'))
                              <span style="color: red;">{{ $errors->first('aadhaar_back') }}</span>
                          @endif
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Upload 10th Marksheet</label>
                          <input type='file' name="tenth" onchange="tenthLoad(this);" required="">
                          <img id="tenth"  src="#" alt="your image" style="margin-top: 10px;" />
                          @if($errors->has('tenth'))
                              <span style="color: red;">{{ $errors->first('tenth') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <div class="form-group">
                          <label>Upload 12th Marksheet</label>
                          <input type='file' name="tweleth" onchange="twelethLoad(this);" required="">
                          <img id="tweleth"  src="#" alt="your image" style="margin-top: 10px;" />
                          @if($errors->has('tweleth'))
                              <span style="color: red;">{{ $errors->first('tweleth') }}</span>
                          @endif
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>If you have any diploma upload document (optional)</label>
                          <input type='file' name="diploma" onchange="diplomaLoad(this);" />
                          <img id="diploma"  src="#" alt="your image" style="margin-top: 10px;" />
                          @if($errors->has('diploma'))
                              <span style="color: red;">{{ $errors->first('diploma') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <div class="form-group">
                          <label>Upload Caste Certificate</label>
                          <input type='file' name="caste" onchange="casteLoad(this);" required="">
                          <img id="caste"  src="#" alt="your image" style="margin-top: 10px;" />
                          @if($errors->has('caste'))
                              <span style="color: red;">{{ $errors->first('caste') }}</span>
                          @endif
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Upload Graguation Document</label>
                          <input type='file' name="graguation" onchange="graguationLoad(this);" required="">
                          <img id="graguation"  src="#" alt="your image" style="margin-top: 10px;" />
                          @if($errors->has('graguation'))
                              <span style="color: red;">{{ $errors->first('graguation') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <div class="form-group">
                          <label>Upload Post Graguation Document (optional)</label>
                          <input type='file' name="postgraguation" onchange="postgraguationLoad(this);" required="">
                          <img id="postgraguation"  src="#" alt="your image" style="margin-top: 10px;" />
                          @if($errors->has('postgraguation'))
                              <span style="color: red;">{{ $errors->first('postgraguation') }}</span>
                          @endif
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Upload Others Document</label>
                          <input type='file' name="others" onchange="othersLoad(this);" required="">
                          <img id="others"  src="#" alt="your image" style="margin-top: 10px;" />
                          @if($errors->has('others'))
                              <span style="color: red;">{{ $errors->first('others') }}</span>
                          @endif
                        </div>
                      </div>
                    </div><br>
                    <button type="submit" class="btn btn-info pull-right">Update Profile</button>
                    <div class="clearfix"></div>
                  </form>
                </div>

                @else
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Dear {{ \Auth::user()->name }}</h4>
                  <p class="card-category">Update Your Profile.</p>
                </div>
                <div class="card-body">
                  <form method="post" action="{{ url('form-filler/profile/update-info') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Email</label>
                          <input type="text" class="form-control" name="email" value="{{ \Auth::user()->email }}" autocomplete="off" required="">
                          @if($errors->has('email'))
                              <span style="color: red;">{{ $errors->first('email') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Contact Number</label>
                          <input type="text" class="form-control" name="contact_number" value="{{ \Auth::user()->contact_number }}" autocomplete="off" required="">
                          @if($errors->has('contact_number'))
                              <span style="color: red;">{{ $errors->first('contact_number') }}</span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Name</label>
                          <input type="text" class="form-control" name="name" value="{{ \Auth::user()->name }}" autocomplete="off" required="">
                          @if($errors->has('name'))
                              <span style="color: red;">{{ $errors->first('name') }}</span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Gender</label><br>
                          @if($user_infos->userInfo['gender'] == 'Male')
                            <input class="w3-radio" type="radio" name="gender" value="Male" checked="">
                            <label>Male</label>
                            <input class="w3-radio" type="radio" name="gender" value="Female">
                            <label>Female</label>
                          @else($user_infos->userInfo['gender'] == 'Female')
                            <input class="w3-radio" type="radio" name="gender" value="Male">
                            <label>Male</label>
                            <input class="w3-radio" type="radio" name="gender" value="Female" checked="">
                            <label>Female</label>
                          @endif
                          @if($errors->has('gender'))
                              <span style="color: red;">{{ $errors->first('gender') }}</span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Address</label>
                          <input type="text" class="form-control" name="address"  value="{{ \Auth::user()->address }}" autocomplete="off" required="">
                          @if($errors->has('address'))
                              <span style="color: red;">{{ $errors->first('address') }}</span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Father's Name</label>
                          <input type="text" class="form-control" name="f_name" value="{{ $user_infos->userInfo['father_name'] }}" autocomplete="off" required="">
                          @if($errors->has('f_name'))
                              <span style="color: red;">{{ $errors->first('f_name') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Mother's Name</label>
                          <input type="text" class="form-control" name="m_name" value="{{ $user_infos->userInfo['mother_name'] }}" autocomplete="off" required="">
                          @if($errors->has('m_name'))
                              <span style="color: red;">{{ $errors->first('m_name') }}</span>
                          @endif
                        </div>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="">Date Of Birth</label>
                          <input type="date" class="form-control" name="dob" value="{{ $user_infos->userInfo['dob'] }}" autocomplete="off" required="">
                          @if($errors->has('dob'))
                              <span style="color: red;">{{ $errors->first('dob') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Postal Code</label>
                          <input type="number" class="form-control" name="postal_code" value="{{ $user_infos->postal_code }}" autocomplete="off" required="">
                          @if($errors->has('postal_code'))
                              <span style="color: red;">{{ $errors->first('postal_code') }}</span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">City</label>
                          <select type="text" class="form-control" name="city" required="">
                              <option></option>
                              @foreach($data['city'] as $city)
                                @if($user_infos->city_id == $city->id)
                                  <option value="{{ $city->id }}" selected="">{{ $city->name }}</option>
                                @else
                                   <option value="{{ $city->id }}" >{{ $city->name }}</option>
                                @endif
                              @endforeach
                          </select>
                          @if($errors->has('city'))
                              <span style="color: red;">{{ $errors->first('city') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Select Category</label>
                          <select type="text" class="form-control" name="category" required="">
                              <option></option>
                              @foreach($data['categories'] as $category)
                                @if($user_infos->userInfo['category_id'] == $category->id)
                                  <option value="{{ $category->id }}" selected="">{{ $category->name }}</option>
                                @else
                                   <option value="{{ $category->id }}" >{{ $category->name }}</option>
                                @endif
                              @endforeach
                          </select>
                          @if($errors->has('category'))
                              <span style="color: red;">{{ $errors->first('category') }}</span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Licence / Voter id Number</label>
                          <div class="form-group">
                            <input type="text" class="form-control"name="l_v_id" value="{{ $user_infos->userInfo['licence_or_voter_id_number'] }}" autocomplete="off" required="">
                            @if($errors->has('l_v_id'))
                              <span style="color: red;">{{ $errors->first('l_v_id') }}</span>
                            @endif
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Aadhaar Number</label>
                          <div class="form-group">
                            <input type="text" class="form-control" name="aadhaar" value="{{ $user_infos->userInfo['aadhaar_number'] }}" autocomplete="off" required="">
                            @if($errors->has('aadhaar'))
                              <span style="color: red;">{{ $errors->first('aadhaar') }}</span>
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Upload Aadhaar (Front Side)</label>
                          <input type='file' name="aadhaar_front" onchange="readURL(this);">
                          <img id="aadhaar1"  src="{{ $user_infos->userInfo['aadhaar_img_front'] }}" alt="your image" style="margin-top: 10px;max-width: 200px;max-height: 150px;" />
                          @if($errors->has('aadhaar_front'))
                              <span style="color: red;">{{ $errors->first('aadhaar_front') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <div class="form-group">
                          <label>Upload Aadhaar (Back Side)</label>
                          <input type='file' name="aadhaar_back" onchange="readURLNew(this);">
                          <img id="aadhaar2"  src="{{ $user_infos->userInfo['aadhaar_img_back'] }}" alt="your image" style="margin-top: 10px;max-width: 200px;max-height: 150px;" />
                          @if($errors->has('aadhaar_back'))
                              <span style="color: red;">{{ $errors->first('aadhaar_back') }}</span>
                          @endif
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Upload 10th Marksheet</label>
                          <input type='file' name="tenth" onchange="tenthLoad(this);">
                          <img id="tenth"  src="{{ $user_infos->userQualification['tenth_doc_image'] }}" alt="your image" style="margin-top: 10px;max-width: 200px;max-height: 150px;" />
                          @if($errors->has('tenth'))
                              <span style="color: red;">{{ $errors->first('tenth') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <div class="form-group">
                          <label>Upload 12th Marksheet</label>
                          <input type='file' name="tweleth" onchange="twelethLoad(this);">
                          <img id="tweleth"  src="{{ $user_infos->userQualification['tweleth_doc_image'] }}" alt="your image" style="margin-top: 10px;max-width: 200px;max-height: 150px;" />
                          @if($errors->has('tweleth'))
                              <span style="color: red;">{{ $errors->first('tweleth') }}</span>
                          @endif
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>If you have any diploma upload document (optional)</label>
                          <input type='file' name="diploma" onchange="diplomaLoad(this);" />
                          @if($user_infos->userQualification['diploma_doc_image'])
                            <img id="diploma"  src="{{ $user_infos->userQualification['diploma_doc_image'] }}" alt="your image" style="margin-top: 10px;max-width: 200px;max-height: 150px;" />
                          @else
                            <img id="diploma"  src="{{ asset('public/assets3/img/default.png') }}" alt="your image" style="margin-top: 10px;max-width: 200px;max-height: 150px;" />
                          @endif
                          
                          @if($errors->has('diploma'))
                              <span style="color: red;">{{ $errors->first('diploma') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <div class="form-group">
                          <label>Upload Caste Certificate</label>
                          <input type='file' name="caste" onchange="casteLoad(this);">
                          <img id="caste"  src="{{ $user_infos->userQualification['caste_certificate'] }}" alt="your image" style="margin-top: 10px;max-width: 200px;max-height: 150px;" />
                          @if($errors->has('caste'))
                              <span style="color: red;">{{ $errors->first('caste') }}</span>
                          @endif
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Upload Graguation Document</label>
                          <input type='file' name="graguation" onchange="graguationLoad(this);">
                          <img id="graguation"  src="{{ $user_infos->userQualification['graguation'] }}" alt="your image" style="margin-top: 10px;max-width: 200px;max-height: 150px;" />
                          @if($errors->has('graguation'))
                              <span style="color: red;">{{ $errors->first('graguation') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <div class="form-group">
                          <label>Upload Post Graguation Document (optional)</label>
                          <input type='file' name="postgraguation" onchange="postgraguationLoad(this);">
                          @if($user_infos->userQualification['post_graguation'])
                            <img id="postgraguation"  src="{{ $user_infos->userQualification['post_graguation'] }}" alt="your image" style="margin-top: 10px;max-width: 200px;max-height: 150px;" />
                          @else
                            <img id="postgraguation"  src="{{ asset('public/assets3/img/default.png') }}" alt="your image" style="margin-top: 10px;max-width: 200px;max-height: 150px;" />
                          @endif
                          
                          @if($errors->has('postgraguation'))
                              <span style="color: red;">{{ $errors->first('postgraguation') }}</span>
                          @endif
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Upload Others Document (Optional)</label>
                          <input type='file' name="others" onchange="othersLoad(this);">
                          @if($user_infos->userQualification['others'])
                            <img id="others"  src="{{ $user_infos->userQualification['others'] }}" alt="your image" style="margin-top: 10px;max-width: 200px;max-height: 150px;" />
                          @else
                            <img id="others"  src="{{ asset('public/assets3/img/default.png') }}" alt="your image" style="margin-top: 10px;max-width: 200px;max-height: 150px;" />
                          @endif
                          @if($errors->has('others'))
                              <span style="color: red;">{{ $errors->first('others') }}</span>
                          @endif
                        </div>
                      </div>
                    </div><br>
                    <button type="submit" class="btn btn-info pull-right">Update Profile</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
                @endif
              </div>
            </div>
            <div class="col-md-4">
              <form method="post" action="{{ url('form-filler/profile/profile-pic') }}" enctype="multipart/form-data">
              @csrf
              <div class="card card-profile">
                <div class="card-avatar">
                  <a href="javascript:;">
                    @if(\Auth::user()->profile_pic)
                      <img id="profile" src="{{ \Auth::user()->profile_pic }}" class="user-image" alt="User Image">
                    @else
                        <img id="profile" type='file' src="{{ asset('/') }}public/assets/img/default.png" class="user-image" alt="User Image">
                    @endif
                  </a>
                </div>
                
                <div class="card-body">
                  @if($errors->has('image'))
                      <span style="color: red;">{{ $errors->first('image') }}</span>
                  @endif
                  <h4 class="card-title">{{ \Auth::user()->name }}</h4><br>
                  <p class="card-description">
                      {{ \Auth::user()->contact_number }}
                  </p>
                  <p class="card-description">
                      {{ \Auth::user()->email }}
                  </p>
                  @if(\Auth::user()->profile_completed == 'Yes')
                    <input  name="image" class='pis' style="margin-left: 50px;" onchange="profileUpdate(this);" type="file" required="">
                    <input type="submit" class="btn btn-info btn-round" value="Update Profile Photo">
                  @endif
                </div>
              </div>
            </form>
            </div>
           
          </div>
        </div>
      </div>
    </div>
  </div>
  @if(\Auth::user()->profile_completed == 'No')
  <script type="text/javascript">
    document.getElementById('aadhaar1').style.display = "none";
    document.getElementById('aadhaar2').style.display = "none";
    document.getElementById('tweleth').style.display = "none";
    document.getElementById('tenth').style.display = "none";
    document.getElementById('diploma').style.display = "none";
    document.getElementById('caste').style.display = "none";
    document.getElementById('graguation').style.display = "none";
    document.getElementById('postgraguation').style.display = "none";
    document.getElementById('others').style.display = "none";
  </script>
  @endif
  <script type="text/javascript">
    function readURL(input) {
        document.getElementById('aadhaar1').style.display = 'block';
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#aadhaar1')
                  .attr('src', e.target.result)
                  .width(200)
                  .height(150);
          };

            reader.readAsDataURL(input.files[0]);
        }
    }
    function readURLNew(input) {
        document.getElementById('aadhaar1').style.display = 'block';
        document.getElementById('aadhaar2').style.display = 'block';
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#aadhaar2')
                    .attr('src', e.target.result)
                    .width(200)
                    .height(150);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    function tenthLoad(input) {
        document.getElementById('aadhaar1').style.display = 'block';
        document.getElementById('aadhaar2').style.display = 'block';
        document.getElementById('tenth').style.display = 'block';
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#tenth')
                    .attr('src', e.target.result)
                    .width(200)
                    .height(150);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    function twelethLoad(input) {
        document.getElementById('aadhaar1').style.display = 'block';
        document.getElementById('aadhaar2').style.display = 'block';
        document.getElementById('tenth').style.display = 'block';
        document.getElementById('tweleth').style.display = 'block';
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#tweleth')
                    .attr('src', e.target.result)
                    .width(200)
                    .height(150);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function diplomaLoad(input) {
        document.getElementById('aadhaar1').style.display = 'block';
        document.getElementById('aadhaar2').style.display = 'block';
        document.getElementById('tenth').style.display = 'block';
        document.getElementById('tweleth').style.display = 'block';
        document.getElementById('diploma').style.display = 'block';
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#diploma')
                    .attr('src', e.target.result)
                    .width(200)
                    .height(150);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function casteLoad(input) {
        document.getElementById('aadhaar1').style.display = 'block';
        document.getElementById('aadhaar2').style.display = 'block';
        document.getElementById('tenth').style.display = 'block';
        document.getElementById('tweleth').style.display = 'block';
        document.getElementById('diploma').style.display = 'block';
        document.getElementById('caste').style.display = 'block';
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#caste')
                    .attr('src', e.target.result)
                    .width(200)
                    .height(150);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function graguationLoad(input) {
        document.getElementById('aadhaar1').style.display = 'block';
        document.getElementById('aadhaar2').style.display = 'block';
        document.getElementById('tenth').style.display = 'block';
        document.getElementById('tweleth').style.display = 'block';
        document.getElementById('diploma').style.display = 'block';
        document.getElementById('caste').style.display = 'block';
        document.getElementById('graguation').style.display = 'block';
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#graguation')
                    .attr('src', e.target.result)
                    .width(200)
                    .height(150);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function postgraguationLoad(input) {
        document.getElementById('aadhaar1').style.display = 'block';
        document.getElementById('aadhaar2').style.display = 'block';
        document.getElementById('tenth').style.display = 'block';
        document.getElementById('tweleth').style.display = 'block';
        document.getElementById('diploma').style.display = 'block';
        document.getElementById('caste').style.display = 'block';
        document.getElementById('graguation').style.display = 'block';
        document.getElementById('postgraguation').style.display = 'block';
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#postgraguation')
                    .attr('src', e.target.result)
                    .width(200)
                    .height(150);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

     function othersLoad(input) {
        document.getElementById('aadhaar1').style.display = 'block';
        document.getElementById('aadhaar2').style.display = 'block';
        document.getElementById('tenth').style.display = 'block';
        document.getElementById('tweleth').style.display = 'block';
        document.getElementById('diploma').style.display = 'block';
        document.getElementById('caste').style.display = 'block';
        document.getElementById('graguation').style.display = 'block';
        document.getElementById('postgraguation').style.display = 'block';
        document.getElementById('others').style.display = 'block';
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#others')
                    .attr('src', e.target.result)
                    .width(200)
                    .height(150);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function profileUpdate(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#profile')
                    .attr('src', e.target.result)
                    .width(200)
                    .height(150);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    
  </script>
@endsection