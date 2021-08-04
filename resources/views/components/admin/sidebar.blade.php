<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name', 'Laravel') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item
    @if (Route::currentRouteName() === 'blog')
        active
    @endif">
        <a class="nav-link" href="{{url(route('blog'))}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>blog</span></a>
        </li>
        <li class="nav-item
    @if (Route::currentRouteName() === 'dashboard')
        active
    @endif">
            <a class="nav-link" href="{{url(route('dashboard'))}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            {{-- <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Custom Components:</h6>
        <a class="collapse-item" href="buttons.html">Buttons</a>
        <a class="collapse-item" href="cards.html">Cards</a>
    </div>
</div>
</li> --}}
@canany(['viewAny','create'],App\Modles\Category::class)
    {{-- roles --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#categories" aria-expanded="true" aria-controls="categories">
            <i class="fas fa-fw fa-list-alt"></i>
            <span>Categories</span>
        </a>
        <div id="categories" class="collapse
        @if (str_starts_with(Route::currentRouteName(),'categories'))
            show
        @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @can ('create', App\Models\Category::class)
                    <a class="collapse-item
        @if (Route::currentRouteName() === 'categories.create')
            active
        @endif" href="{{url(route('categories.create'))}}">
                        Create A Category
                    </a>
                @endcan
                @can ('viewAny', App\Models\Category::class)
                    <a class="collapse-item
        @if (Route::currentRouteName() === 'categories.index')
            active
        @endif" href="{{url(route("categories.index"))}}">
                        View All Categories
                    </a>
                @endcan
            </div>
        </div>
    </li>
@endcanany

{{-- Posts --}}
@canany(['viewAny','create'],App\Models\Post::class)
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#posts" aria-expanded="true" aria-controls="posts">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>Posts</span>
        </a>
        <div id="posts" class="collapse
        @if (str_starts_with(Route::currentRouteName(),'posts'))
            show
        @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">operations for posts:</h6>
                @can ('create', App\Models\Post::class)
                    <a class="collapse-item
        @if (Route::currentRouteName() === 'posts.create')
            active
        @endif" href="{{url(route('posts.create'))}}">Create A Post</a>
                @endcan
                @can ('viewAny', App\Models\Post::class)
                    <a class="collapse-item
        @if (Route::currentRouteName() === 'posts.index')
            active
        @endif" href="{{url(route('posts.index'))}}">View All Posts</a>
                @endcan
            </div>
        </div>
    </li>
@endcanany

{{-- Users --}}
@canany(['viewAny'],App\Models\User::class)
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#users" aria-expanded="true" aria-controls="users">
            <i class="fas fa-fw fa-users"></i>
            <span>Users</span>
        </a>
        <div id="users" class="collapse
        @if (str_starts_with(Route::currentRouteName(),'users') and !str_starts_with(Route::currentRouteName(),'users.edit')/*because that comes in settings*/)
            show
        @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @can('viewAny' , App\Models\User::class)
                    <a class="collapse-item
        @if (Route::currentRouteName() === 'users.index')
            active
        @endif" href="{{url(route('users.index'))}}">View All Users</a>
                @endcan
            </div>
        </div>
    </li>

@endcanany

{{-- Settings --}}
@canany(['changePassword' , 'update'] , auth()->user())
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#settings" aria-expanded="true" aria-controls="settings">
        <i class="fas fa-fw fa-cog"></i>
        <span>Settings</span>
    </a>
    <div id="settings" class="collapse
        @if (Route::currentRouteName() === 'users.edit' or Route::currentRouteName() == 'users.edit_password')
            show
        @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            @can ('update', auth()->user())
                <a class="collapse-item
        @if (Route::currentRouteName() === 'users.edit')
            active
        @endif" href="{{url(route("users.edit",auth()->id()))}}">
                    Edit profile
                </a>
            @endcan
            @can ('changePassword', auth()->user())
                <a class="collapse-item
        @if (Route::currentRouteName() === 'users.edit_password')
            active
        @endif" href="{{url(route('users.edit_password',auth()->id()))}}">
                    Change Password
                </a>
            @endcan
        </div>
    </div>
</li>

@endcanany

{{-- roles --}}
@canany(['create','viewAny'] , App\Models\Role::class)
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#roles" aria-expanded="true" aria-controls="roles">
            <i class="fas fa-fw fa-user-tag"></i>
            <span>Roles</span>
        </a>
        <div id="roles" class="collapse
        @if (str_starts_with(Route::currentRouteName(),'roles'))
            show
        @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @can ('create', App\Models\Role::class)
                    <a class="collapse-item
        @if (Route::currentRouteName() === 'roles.create')
            active
        @endif" href="{{url(route('roles.create'))}}">
                        Create A Role
                    </a>
                @endcan
                @can ('viewAny', App\Models\Role::class)
                    <a class="collapse-item
        @if (Route::currentRouteName() === 'roles.index')
            active
        @endif" href="{{url(route("roles.index"))}}">
                        View All Roles
                    </a>
                @endcan
            </div>
        </div>
    </li>

@endcanany


<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
