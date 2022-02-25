<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// DASHBOARD ROUTE
Breadcrumbs::for('admin.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('admin.dashboard'));
});

Breadcrumbs::for('admin.feature.index', function (BreadcrumbTrail $trail) {
    $trail->push('About', route('admin.feature.index'));
});

Breadcrumbs::for('setting.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Setting', route('setting.index'));
});




// GALLERY ROUTE
Breadcrumbs::for('gallery.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Gallry Create', route('gallery.create'));
});

Breadcrumbs::for('gallery.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Gallry List', route('gallery.index'));
});

Breadcrumbs::for('gallery.edit', function (BreadcrumbTrail $trail, $gallery) {
    $trail->parent('gallery.index');
    $trail->push($gallery->title, route('gallery.edit', $gallery));
});


// PROJECT ROUTE
Breadcrumbs::for('project.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Project List', route('project.index'));
});
Breadcrumbs::for('project.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Project Create', route('project.create'));
});

Breadcrumbs::for('up_comming', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Up-Comming Project', route('project.create'));
});

Breadcrumbs::for('project.set_upcomming', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Up-Comming Form', route('up_comming'));
});



Breadcrumbs::for('blog.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Blog List', route('blog.index'));
});

Breadcrumbs::for('blog.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Blog Create', route('blog.create'));
});


Breadcrumbs::for('product.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Product List', route('product.index'));
});

Breadcrumbs::for('product.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Product Create', route('product.create'));
});




Breadcrumbs::for('client-category.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Category', route('client-category.index'));
});

Breadcrumbs::for('client-category.create', function (BreadcrumbTrail $trail) {
    $trail->parent('client-category.index');
    $trail->push('Category Create', route('client-category.create'));
});

Breadcrumbs::for('client-category.edit', function (BreadcrumbTrail $trail, $clientCategory) {
    $trail->parent('client-category.index');
    $trail->push($clientCategory->title, route('client-category.edit', $clientCategory));
});

Breadcrumbs::for('getClientsWithCategory', function (BreadcrumbTrail $trail, $clientCategory) {
    $trail->parent('client-category.index');
    $trail->push($clientCategory->title, route('getClientsWithCategory', $clientCategory));
});




Breadcrumbs::for('client.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Client List', route('client.index'));
});

Breadcrumbs::for('client.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Client Create', route('client.create'));
});


Breadcrumbs::for('getClients', function ($trail) {
    $trail->push('Title Here', route('getClients'));
});


Breadcrumbs::for('feature.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.feature.index');
    $trail->push('Feature List', route('feature.index'));
});

Breadcrumbs::for('feature.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Feature Create', route('feature.create'));
});



Breadcrumbs::for('whychooseus.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Why Choose Us List', route('whychooseus.index'));
});

Breadcrumbs::for('whychooseus.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Why Choose Us Create', route('whychooseus.create'));
});





Breadcrumbs::for('about.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('About List', route('about.index'));
});

Breadcrumbs::for('news.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('News/Notice List', route('news.index'));
});

Breadcrumbs::for('about.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('About Create', route('about.create'));
});

Breadcrumbs::for('news.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('News/Notice Create', route('news.create'));
});


Breadcrumbs::for('service.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Service List', route('service.index'));
});


Breadcrumbs::for('portfolio.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Sector List', route('portfolio.index'));
});

Breadcrumbs::for('organization.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Organization List', route('organization.index'));
});

Breadcrumbs::for('team.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Team List', route('team.index'));
});

Breadcrumbs::for('ourTeam.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Our Team ', route('ourTeam.index'));
});

Breadcrumbs::for('bannerVideo.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Banner Video ', route('bannerVideo.index'));
});



Breadcrumbs::for('service.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Service Create', route('service.create'));
});



Breadcrumbs::for('portfolio.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Sector Create', route('portfolio.create'));
});

Breadcrumbs::for('organization.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Organization Create', route('organization.create'));
});

Breadcrumbs::for('team.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Team Create', route('team.create'));
});




Breadcrumbs::for('project.edit', function (BreadcrumbTrail $trail, $project) {
    $trail->parent('admin.dashboard');
    $trail->push($project->title, route('project.edit', $project));
});

Breadcrumbs::for('news.edit', function (BreadcrumbTrail $trail, $project) {
    $trail->parent('admin.dashboard');
    $trail->push($project->title, route('news.edit', $project));
});

Breadcrumbs::for('bannerVideo.edit', function (BreadcrumbTrail $trail, $project) {
    $trail->parent('admin.dashboard');
    $trail->push($project->title, route('bannerVideo.edit', $project));
});


Breadcrumbs::for('ourTeam.edit', function (BreadcrumbTrail $trail, $project) {
    $trail->parent('admin.dashboard');
    $trail->push($project->title, route('ourTeam.edit', $project));
});




Breadcrumbs::for('organization.edit', function (BreadcrumbTrail $trail, $project) {
    $trail->parent('admin.dashboard');
    $trail->push($project->title, route('organization.edit', $project));
});

Breadcrumbs::for('portfolio.edit', function (BreadcrumbTrail $trail, $project) {
    $trail->parent('admin.dashboard');
    $trail->push($project->title, route('portfolio.edit', $project));
});

Breadcrumbs::for('blog.edit', function (BreadcrumbTrail $trail, $project) {
    $trail->parent('admin.dashboard');
    $trail->push($project->title, route('blog.edit', $project));
});


Breadcrumbs::for('product.edit', function (BreadcrumbTrail $trail, $product) {
    $trail->parent('admin.dashboard');
    $trail->push($product->title, route('product.edit', $product));
});

Breadcrumbs::for('client.edit', function (BreadcrumbTrail $trail, $client) {
    $trail->parent('admin.dashboard');
    $trail->push($client->name, route('client.edit', $client));
});



Breadcrumbs::for('feature.edit', function (BreadcrumbTrail $trail, $feature) {
    $trail->parent('admin.dashboard');
    $trail->push($feature->title, route('feature.edit', $feature));
});

Breadcrumbs::for('whychooseus.edit', function (BreadcrumbTrail $trail, $client) {
    $trail->parent('admin.dashboard');
    $trail->push($client->name, route('whychooseus.edit', $client));
});



Breadcrumbs::for('about.edit', function (BreadcrumbTrail $trail, $about) {
    $trail->parent('admin.dashboard');
    $trail->push($about->title, route('about.edit', $about));
});

Breadcrumbs::for('service.edit', function (BreadcrumbTrail $trail, $service) {
    $trail->parent('admin.dashboard');
    $trail->push($service->title, route('service.edit', $service));
});




Breadcrumbs::for('team.edit', function (BreadcrumbTrail $trail, $team) {
    $trail->parent('admin.dashboard');
    $trail->push($team->name, route('team.edit', $team));
});



Breadcrumbs::for('get-status-project', function (BreadcrumbTrail $trail, $check) {
    $trail->parent('project.index');
    $trail->push($check, route('get-status-project', $check));
});

Breadcrumbs::for('get-status-team', function (BreadcrumbTrail $trail, $check) {
    $trail->parent('project.index');
    $trail->push($check, route('get-status-team', $check));
});

Breadcrumbs::for('get-status-org', function (BreadcrumbTrail $trail, $check) {
    $trail->parent('organization.index');
    $trail->push($check, route('get-status-org', $check));
});

Breadcrumbs::for('get-status-sector', function (BreadcrumbTrail $trail, $check) {
    $trail->parent('project.index');
    $trail->push($check, route('get-status-sector', $check));
});

Breadcrumbs::for('get-status-product', function (BreadcrumbTrail $trail, $check) {
    $trail->parent('product.index');
    $trail->push($check, route('get-status-product', $check));
});

Breadcrumbs::for('get-status-blog', function (BreadcrumbTrail $trail, $check) {
    $trail->parent('blog.index');
    $trail->push($check, route('get-status-blog', $check));
});

Breadcrumbs::for('get-status-client', function (BreadcrumbTrail $trail, $check) {
    $trail->parent('client.index');
    $trail->push($check, route('get-status-client', $check));
});

Breadcrumbs::for('get-status-feature', function (BreadcrumbTrail $trail, $check) {
    $trail->parent('feature.index');
    $trail->push($check, route('get-status-feature', $check));
});


Breadcrumbs::for('get-status-service', function (BreadcrumbTrail $trail, $check) {
    $trail->parent('service.index');
    $trail->push($check, route('get-status-blog', $check));
});




?>