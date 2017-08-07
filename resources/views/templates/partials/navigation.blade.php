<div class="blog-masthead">
    <nav class="blog-nav">
        <div class="container">
            <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-color">
                        <li><a href="{{route('home')}}">Events & Thoughts</a></li>
                        <li><a href="{{route('quizzer.index')}}">PHP Quizzer</a></li>
                        @if (Auth::check())
                            <form action="#" role="search" class="navbar-form navbar-left">
                                <div class="form-group">
                                    <input type="text" name="query" class="form-control"
                                       placeholder="Find blog or people"/>
                                </div>
                                <button type="submit" class="btn btn-default">Search</button>
                            </form>
                            <li><a href="#">My Contacts</a></li>
                            <li><a href="{{route('blog.createBlogs')}}">create a blog</a></li>
                        @endif
                    </ul>

                <ul class="nav navbar-nav navbar-right navbar-color">
                    @if(Auth::check())
                        <li><a href="{{route('personalInfo')}}" class="addModal">{{Auth::user()->getUsername() }}</a></li>
                        <li><a href="{{route('auth.logOut')}}">Log out</a></li>
                    @else
                        <li><a href="{{route('auth.createAccount')}}">Create An Account</a></li>
                        <li><a href="{{route('auth.logIn')}}">Log in</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</div>

<script>
    var token = '{{ Session::token() }}';
    var urlEdit = '#';
</script>