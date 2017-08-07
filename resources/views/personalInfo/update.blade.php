@extends('templates.default')

@section('content')
        <b>Let Another Bloggers Know You More:</b><hr>
        <form id="addContact" action="{{route('personalInfo')}}" method="post">
            <div class="row formLayout">
                <div class="col-lg-6">
                    <label for="first_name" class="control-label">First name
                        <input name="first_name" id="first_name" type="text" value="{{Request::old('first_name')?:Auth::user()->first_name}}"/>
                    </label>
                </div>
                <div class="col-lg-6">
                    <label for="last_name" class="control-label">Last name
                        <input name="last_name" id="last_name" type="text" value="{{Request::old('last_name')?:Auth::user()->last_name}}"/>
                    </label>
                </div>
            </div>
            <div class="row formLayout">
                <div class="col-lg-6">
                    <label for="position" class="control-label">Position
                        <input name="position" id="position" type="text" value="{{Request::old('position')?:Auth::user()->position}}"/>
                    </label>
                </div>
                <div class="col-lg-6">
                    <label for="phone" class="control-label">Phone Num
                        <input name="phone" id="phone" type="text" value="{{Request::old('phone')?:Auth::user()->phone}}"/>
                    </label>
                </div>
            </div>
            <div class="row formLayout">
                <div class="col-lg-6">
                    <label for="first_address" class="control-label">Address 1
                        <input name="first_address" id="first_address" type="text" value="{{Request::old('first_address')?:Auth::user()->first_address}}"/>
                    </label>
                </div>
                <div class="col-lg-6">
                    <label for="second_address" class="control-label">Address 2
                        <input name="second_address" id="second_address" type="text" value="{{Request::old('second_address')?:Auth::user()->second_address}}"/>
                    </label>
                </div>
            </div>
            <div class="row formLayout">
                <div class="col-lg-12">
                    <label for="hobby" class="control-label">Hobby & Intreast
                        <input style="width: 568px;" name="hobby" id="hobby" type="text" value="{{Request::old('hobby')?:Auth::user()->hobby}}"/>
                    </label>
                </div>
            </div>
            <div class="row formLayout">
                <div class="col-lg-12">
                    <label for="status" class="control-label">Status
                        <textarea style="width: 740px;" name="status" id="status" placeholder="Write something in your mind" value="{{Request::old('status')?:Auth::user()->status}}}}"></textarea>
                    </label>
                </div>
            </div>
            <input name="submit" type="submit" class="btn btn-default" value="Update"/>
            <input type="hidden" name="_token" value="{{Session::token()}}">
        </form>
@endsection