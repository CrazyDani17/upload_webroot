@extends('Layouts.main_template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Contact Form</span>
                </div>
                <div class="card-body">   
                  @if ( session('alert') )
                    <div class="alert alert-success">{{ session('alert') }}</div>
                  @endif
                  <form method="POST" action="/contact/send_mail">
                    @csrf
                    @error('name')
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Name is required
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    @enderror 
                    @if ($errors->has('email'))
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Email is required
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    @endif
                    @if ($errors->has('subject'))
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Subject is required
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    @endif
                    @if ($errors->has('body'))
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Body is required
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    @endif
                    <input type="text" name="name" placeHolder="Name" class="form-control mb-2" value="{{ old('name') }}">
                    <input type="email" name="email" placeHolder="Email" class="form-control mb-2" value="{{ old('email') }}">
                    <input type="text" name="subject" placeHolder="Subject" class="form-control mb-2" value="{{ old('subject') }}">
                    <textarea class="form-control" name="body" placeholder="Body"></textarea>
                    <br>
                    <!---label for="floatingTextarea">Body</label--->
                    <button class="btn btn-primary btn-block" type="submit">Submit</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection