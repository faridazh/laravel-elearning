<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Single Pages
    // Home
    Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
        $trail->push('<i class="fas fa-home fa-fw"></i>', route('home'));
    });

    // About
    Breadcrumbs::for('about', function (BreadcrumbTrail $trail) {
        $trail->parent('home');
        $trail->push(__('breadcrumb.about'), route('about'));
    });

// Profile Pages
    // Profile
    Breadcrumbs::for('profile', function (BreadcrumbTrail $trail) {
        $trail->parent('home');
        $trail->push(__('breadcrumb.profile.title'), url()->current());
    });

    // Profile > Username (Auth)
    Breadcrumbs::for('my-profile', function (BreadcrumbTrail $trail) {
        $trail->parent('profile');
        $trail->push(Auth::user()->name, route('profile', Auth::user()->username));
    });

    // Profile > Username (Users)
    Breadcrumbs::for('user-profile', function (BreadcrumbTrail $trail, $user) {
        $trail->parent('profile');
        $trail->push($user->name, route('profile', $user->username));
    });

    // Profile > Username > Forum
    Breadcrumbs::for('user-profile-forum', function (BreadcrumbTrail $trail, $user) {
        $trail->parent('user-profile', $user);
        $trail->push(__('breadcrumb.profile.forum'), route('profile_forums', $user->username));
    });

    // Profile > Username > Ulasan
    Breadcrumbs::for('user-profile-ulasan', function (BreadcrumbTrail $trail, $user) {
        $trail->parent('user-profile', $user);
        $trail->push(__('breadcrumb.profile.ulasan'), route('profile_reviews', $user->username));
    });

// Setting Pages
    // Setting
    Breadcrumbs::for('setting', function (BreadcrumbTrail $trail) {
        $trail->parent('my-profile');
        $trail->push(__('breadcrumb.settings.title'), route('setting'));
    });

    // Setting > Profile
    Breadcrumbs::for('setting-account', function (BreadcrumbTrail $trail) {
        $trail->parent('setting');
        $trail->push(__('breadcrumb.profile.title'), route('setting-account'));
    });

    // Setting > Private
    Breadcrumbs::for('setting-private', function (BreadcrumbTrail $trail) {
        $trail->parent('setting');
        $trail->push(__('breadcrumb.settings.private'), route('setting-private'));
    });

    // Setting > Password
    Breadcrumbs::for('setting-password', function (BreadcrumbTrail $trail) {
        $trail->parent('setting');
        $trail->push(__('breadcrumb.settings.password'), route('setting-password'));
    });

    // Setting > Forum
    Breadcrumbs::for('setting-forum', function (BreadcrumbTrail $trail) {
        $trail->parent('setting');
        $trail->push(__('breadcrumb.settings.forum'), route('setting-forum'));
    });

    // Setting > Balasan Forum
    Breadcrumbs::for('setting-balasan', function (BreadcrumbTrail $trail) {
        $trail->parent('setting');
        $trail->push(__('breadcrumb.settings.reply'), route('setting-balasan'));
    });

    // Setting > Ulasan
    Breadcrumbs::for('setting-ulasan', function (BreadcrumbTrail $trail) {
        $trail->parent('setting');
        $trail->push(__('breadcrumb.settings.ulasan'), route('setting-ulasan'));
    });

// Course Pages
    // Kursus
    Breadcrumbs::for('kursus', function (BreadcrumbTrail $trail) {
        $trail->parent('home');
        $trail->push(__('breadcrumb.course.index'), route('courses'));
    });

    Breadcrumbs::for('kursus-create', function (BreadcrumbTrail $trail) {
        $trail->parent('kursus');
        $trail->push(__('breadcrumb.course.create'), route('course_create'));
    });

    Breadcrumbs::for('kursus-show', function (BreadcrumbTrail $trail, $course) {
        $trail->parent('kursus');
        $trail->push($course->name, route('course_show', $course->slug));
    });

    Breadcrumbs::for('kursus-edit', function (BreadcrumbTrail $trail, $course) {
        $trail->parent('kursus-show', $course);
        $trail->push(__('breadcrumb.course.edit'), route('course_edit', $course->slug));
    });

    Breadcrumbs::for('kursus-forum-index', function (BreadcrumbTrail $trail, $course) {
        $trail->parent('kursus-show', $course);
        $trail->push(__('breadcrumb.course.forum'), route('course_forum', $course->slug));
    });

    Breadcrumbs::for('kursus-ulasan-index', function (BreadcrumbTrail $trail, $course) {
        $trail->parent('kursus-show', $course);
        $trail->push(__('breadcrumb.course.ulasan'), route('course_forum', $course->slug));
    });

    Breadcrumbs::for('kursus-bab', function (BreadcrumbTrail $trail, $course) {
        $trail->parent('kursus-edit', $course);
        $trail->push(__('breadcrumb.bab.index'));
    });

    Breadcrumbs::for('kursus-bab-show', function (BreadcrumbTrail $trail, $course, $courseMateri) {
        $trail->parent('kursus-show', $course);
        $trail->push($courseMateri->bab->name);
    });

//    Breadcrumbs::for('kursus-bab-create', function (BreadcrumbTrail $trail, $course) {
//        $trail->parent('kursus-bab', $course);
//        $trail->push(__('breadcrumb.bab.create'));
//    });
//
//    Breadcrumbs::for('kursus-bab-edit', function (BreadcrumbTrail $trail, $course) {
//        $trail->parent('kursus-bab', $course);
//        $trail->push(__('breadcrumb.bab.create'));
//    });

    Breadcrumbs::for('kursus-materi', function (BreadcrumbTrail $trail, $course, $courseMateri) {
        $trail->parent('kursus-bab-show', $course, $courseMateri);
        $trail->push($courseMateri->name, route('course_materi', [$course->slug, $courseMateri->bab->slug, $courseMateri->slug]));
    });
