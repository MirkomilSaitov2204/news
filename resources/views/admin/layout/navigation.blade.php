<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="./"><img src="{{ asset('admin/images/logo.png') }}" alt="Logo"></a>
            <a class="navbar-brand hidden" href="./"><img src="{{ asset('admin/images/logo2.png') }}" alt="Logo"></a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="index.html"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                </li>

                <li>
                        <a href="{{ route('permission') }}"> <i class="menu-icon"></i>All Permissions list</a>
                    </li>
                    <li>
                        <a href="{{ route('roles') }}"> <i class="menu-icon"></i>All Roles list</a>
                    </li>
                    <li>
                        <a href="{{ route('authors') }}"> <i class="menu-icon"></i>All Authors list</a>
                    </li>
                    <li>
                        <a href="{{ route('categories') }}"> <i class="menu-icon"></i>All Categories list</a>
                    </li>
                    <li>
                        <a href="{{ route('posts') }}"> <i class="menu-icon"></i>All Posts list</a>
                    </li>

            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->
