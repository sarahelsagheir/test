<template>
           <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                <span class="glyphicon glyphicon-globe"></span> Notifications <span class="badge">{{count(auth::user()->unreadNotifications)}}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <li>
                                    @foreach(auth()->user()->unreadNotifications as $notification)
                                    @include('notification.'.Str::snake(class_basename($notification->type)))
                                    @endforeach
                                </li>

                            </ul>

                        </li>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
