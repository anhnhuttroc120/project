@extends('default.master')
@section('content')

        <div id="content">
            
            <form action="{{ route('password.email') }}" method="post" class="beta-form-checkout">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <h4 style="font-weight: bold;">Quên mật khẩu</h4>
                        <div class="space20">&nbsp;</div>       
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif
                        <div class="form-block">
                            <label for="email">Địa chỉ email</label>
                            <input type="text" id="email"  name="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span style="color: red;margin-left: 220px;" class="invalid-feedback">
                                       {{ $errors->first('email') }}
                                    </span>
                                @endif
                        </div>
                        
                                
                        <div class="form-block" style="padding-left: 200px;">
                            <button style="background: #ce3029;color:#e7e7e7" type="submit" class="btn">Gửi về email</button>

                        </div>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
            </form>
        </div> <!-- #content -->



@endsection
