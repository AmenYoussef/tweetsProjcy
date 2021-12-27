@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class='post'>
             <h3>{{ __('Post') }}</h3>
                <form action='{{ route('createPost') }}' method='POST'>
                        @csrf
                    <div class="form-group">
                        <textarea class="form-control" name='contant' max='140' id="exampleFormControlTextarea1" rows="3"
                        
                        ></textarea>
                    </div>
                    <div class="form-group">
                    <input type="number" style='display:none' name="owner" value="{{Auth::id()}}">
                    </div>
                      <button type="submit" class="btn btn-primary mb-2">{{ __('Submit') }}</button>
                </form>
            </div>
            <div>
                <h3>{{ __('Time Line') }}</h3>
                @foreach ($posts as $post)
                @php
                    $user = DB::table('users')->where('id', $post->owner)->first();
                @endphp
                    <div class="media" style='padding:10px;background: #f3f3f3;border-radius: 11px;margin-bottom: 16px;'>
                        <img src="{{asset('def.jpg')}}" style='width:60px' class="mr-3">
                        <div class="media-body">
                            <h5 class="mt-0">{{$user->name}}</h5>
                            <p>{{$post->contant}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class='col-md-4'>
            <div class='follower'>
                <h3>{{ __('member') }}</h3>
                @php
                    $usersTofollowr = DB::table('users')->whereNotIn('id', [Auth::user()->id] )->get();
                @endphp

                @foreach ($usersTofollowr as $userTofollowr)
                    @php
                                $checkTofollowr = DB::table('followers')->where('userID', '=', Auth::id())
                                                                        ->where('folowerID', '=', $userTofollowr->id)
                                                                        ->get();

                    @endphp
                        


                    <div class="card" style="width: 18rem;margin-top:10px">
                    <img src="{{asset('def.jpg')}}" class="mr-3" style='width:60px;margin: 0 40%;'  alt="...">
                    <div class="card-body" style='text-align: center;'>
                        <h5 class="card-title">{{$userTofollowr->name}}</h5>
                        @if($checkTofollowr->count() == 0)  
                        <form action='{{ route('follow') }}' method='POST'>
                        @csrf
                            <input type="text" style='display:none' name="userID" value="{{Auth::id()}}">
                            <input type="text" style='display:none' name="folowerID" value="{{$userTofollowr->id}}">

                            <button type='submit'  class="card-link btn btn-primary">{{ __('Follow') }}</button>
                        </form>
                        @else
                        <form action='{{ route('unfollow', $checkTofollowr[0]->id) }}' method='POST'>
                        @csrf
                        <input type='text' name='id' style='display:none' value='{{$checkTofollowr[0]->id}}'>
                            <button type='submit'  class="card-link btn btn-primary">{{ __('unFollow') }}</button>
                        </form>
                        @endif

                    </div>
                    </div>

                @endforeach


            </div>
        </div>
    </div>
</div>
@endsection
