<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
            <li class="sidebar-toggler-wrapper">
                <div class="sidebar-toggler hidden-phone">
                </div>
            </li>
            <li class="start">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span class="title">Потребители</span>
                </a>
                <ul class="sub-menu">
                    <li>
                        {{--!! link_to_route('admin.users.index', 'Всички') !!--}}
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-pencil-square-o"></i>
                    <span class="title">Постове</span>
                </a>
                <ul class="sub-menu">
                    <li>
                        {!! link_to_route('admin.posts.index', 'Публикувани') !!}
                    </li>
                    <li>
                        {!! link_to_route('admin.awaiting_posts.index', 'Чакащи') !!}
                    </li>
                    <li>
                        {!! link_to_route('admin.comments.index', 'Коментари') !!}
                    </li>
                    <li>
                        {!! link_to_route('admin.categories.index', 'Категории') !!}
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
