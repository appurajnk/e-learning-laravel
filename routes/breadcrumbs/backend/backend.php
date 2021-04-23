<?php

Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push(__('strings.backend.dashboard.title'), route('admin.dashboard'));
});

Breadcrumbs::for('admin.categories', function ($trail) {
    $trail->push(__('strings.categories'), route('admin.categories'));
});

Breadcrumbs::for('admin.courses.all', function ($trail) {
    $trail->push(__('strings.courses'), route('admin.courses.all'));
});

Breadcrumbs::for('admin.courses.details', function ($trail, $uuid) {
    $course = \App\Models\Course::where('uuid', $uuid)->first();
    $trail->parent('admin.courses.all');
    $trail->push($course->title, route('admin.courses.details', $course->uuid));
});


Breadcrumbs::for('admin.coupons', function ($trail) {
    $trail->push(__('strings.discount_coupons'), route('admin.coupons'));
});

Breadcrumbs::for('admin.finances.transactions', function ($trail) {
    $trail->push(__('strings.transactions'), route('admin.finances.transactions'));
});

Breadcrumbs::for('admin.finances.payout.periods.details', function ($trail, $uuid) {
    $period = \App\Models\Period::where('uuid', $uuid)->first();
    $trail->parent('admin.finances.payout.periods');
    $trail->push($period->start_time->format('Y-m-d') . " - " . $period->end_time->format('Y-m-d'), route('admin.finances.payout.periods.details', $uuid));
});

Breadcrumbs::for('admin.finances.payout.periods', function ($trail) {
    $trail->push(__('strings.payouts'), route('admin.finances.payout.periods'));
});


Breadcrumbs::for('admin.finances.refunds', function ($trail) {
    $trail->push(__('strings.refunds'), route('admin.finances.refunds'));
});


Breadcrumbs::for('admin.settings', function ($trail) {
    $trail->push(__('strings.settings'), route('admin.settings'));
});


Breadcrumbs::for('admin.translations.index', function ($trail) {
    $trail->push(__('strings.translations'), route('admin.translations.index'));
});
Breadcrumbs::for('admin.translations.edit', function ($trail, $language) {
    $trail->parent('admin.translations.index');
    $trail->push(strToUpper($language), route('admin.translations.edit', $language));
});


Breadcrumbs::for('admin.pages', function ($trail) {
    $trail->push(__('strings.pages'), route('admin.pages'));
});

Breadcrumbs::for('admin.pages.edit', function ($trail, $uuid) {
    $trail->parent('admin.pages');
    $trail->push(__('strings.edit'), route('admin.pages.edit', $uuid));
});
Breadcrumbs::for('admin.pages.create', function ($trail) {
    $trail->parent('admin.pages');
    $trail->push(__('strings.create'), route('admin.pages.create'));
});

Breadcrumbs::for('admin.locales.index', function ($trail) {
    $trail->push(__('strings.locale_manager'), route('admin.locales.index'));
});
Breadcrumbs::for('admin.locales.view', function ($trail) {
    $trail->push(__('strings.locale_manager'), route('admin.locales.view'));
});

require __DIR__.'/auth.php';
require __DIR__.'/log-viewer.php';
