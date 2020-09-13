<template>
    <div class="uk-container uk-container-large">
        <nav class="uk-navbar-container uk-navbar-transparent" uk-navbar>
            <div class="uk-navbar-right">
                <ul class="uk-navbar-nav">
                    <li class="uk-active"><router-link to="/" class="nav-item nav-link">Car List</router-link></li>
                    <li class="uk-parent"><router-link to="/add" class="nav-item nav-link">Add Car</router-link></li>
                </ul>
            </div>
        </nav>
        <router-view></router-view>
    </div>
</template>

