<?php

/*
|--------------------------------------------------------------------------
| Load The Cached Routes
|--------------------------------------------------------------------------
|
| Here we will decode and unserialize the RouteCollection instance that
| holds all of the route information for an application. This allows
| us to instantaneously load the entire route map into the router.
|
*/

app('router')->setCompiledRoutes(
    array (
  'compiled' => 
  array (
    0 => false,
    1 => 
    array (
      '/sanctum/csrf-cookie' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'sanctum.csrf-cookie',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_ignition/health-check' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ignition.healthCheck',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_ignition/execute-solution' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ignition.executeSolution',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_ignition/update-config' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ignition.updateConfig',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'login',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'POST' => 1,
            'HEAD' => 2,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::N9PaGT575a8wg0oN',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::6qNXyqXS5cCMltlo',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/map/data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hSotlzD5kzM2ANsv',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/cek-map' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::LsZiZBtybv8Oi64n',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/cek-map/data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::rdAZlZ8n4lE9wQFV',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/add-to-cart' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::T7BoTTRdXeFP9nsb',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/remove-from-cart' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::sjYtNUfnu5UOZPRR',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/get-cart-items' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::2E01yGDfupreUBQe',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/useraffiliate' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'useraffiliate.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'useraffiliate.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/useraffiliate/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'useraffiliate.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/calon-vendor' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'calon-vendor.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'calon-vendor.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/data/province' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Qf5fkMLmsFbaag1l',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/data/city' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::jmevo9veIdf9OsHn',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/data/type' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::x8ZbuMsEXTFj2esY',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/data/item/datatable' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::fBMhEgrogv7GqhwZ',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/data/item/card' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ltOR7w4EHop1NypR',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/data/item/post-item' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::sF5NzmZhKU0z7Z0T',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/data/item/show-data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::V0KLpEcn6lwiHMh1',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/data/item/generate-slug' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::9vL3bLAj5cTWMlDd',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dashboard',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/titik' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dashboard.titik',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/titik-public' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dashboard.titik.public',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/article' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dashboard.article',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/dashboard-portfolio' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dashboard.portfolio',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/inbox/datatable' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dashboard.inbox.datatable',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/inbox/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dashboard.inbox.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/inbox/notif' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dashboard.inbox.notif',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/tags' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.tags',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/tags/add' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.tags.add',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/profile' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.profile',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'POST' => 1,
            'HEAD' => 2,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/artikel/datatable' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.article.datatable',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/artikel' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.article',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/artikel/data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.article.data',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'POST' => 1,
            'HEAD' => 2,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/artikel/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.article.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/service/datatable' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.service.datatable',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/service' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.service',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/service/data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.service.data',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'POST' => 1,
            'HEAD' => 2,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/service/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.service.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/portfolio/datatable' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.portfolio.datatable',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/portfolio' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.portfolio',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/portfolio/data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.portfolio.data',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'POST' => 1,
            'HEAD' => 2,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/portfolio/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.portfolio.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/clients/datatable' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.clients.datatable',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/clients' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.clients',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/clients/data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.clients.data',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/clients/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.clients.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/about' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.about',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'POST' => 1,
            'HEAD' => 2,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/testimoni/datatable' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.testimoni.datatable',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/testimoni' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.testimoni',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/testimoni/data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.testimoni.data',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/testimoni/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.testimoni.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/analytics' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.analytics',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/analytics/data/monthly' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'analytics.monthly',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/analytics/data/daily' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'analytics.daily',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/analytics/data/content' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'analytics.content',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/analytics/data/city-date' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'analytics.city-date',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/analytics/data/city-month' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'analytics.city-month',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/inbox' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::eUJiXu0asQO9NmwF',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::G2Btda1nIPiXlEIK',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
    ),
    2 => 
    array (
      0 => '{^(?|/lang/([^/]++)(*:21)|/map/data/([^/]++)(*:46)|/cek\\-map/data\\-detail/([^/]++)(*:84)|/da(?|ftar_mitra/(?|([^/]++)(*:119)|store(*:132))|ta/(?|province/([^/]++)/city(*:169)|item/(?|delete/([^/]++)(*:200)|url\\-street\\-view/([^/]++)(*:234)|by\\-id/([^/]++)(*:257))))|/(en|id)(?|(*:279)|/(?|home(*:295)|become\\-partner(*:318)|artikel(?|(*:336)|/(?|([^/]++)(*:356)|tag/([^/]++)(*:376)))|services(*:394)|titik(?|/([^/]++)(?|(*:422)|/([^/]++)(*:439))|\\-k(?|ota/([^/]++)(*:466)|ami(*:477)))|contact(*:494)|portfolio(*:511)|listing/([^/]++)(*:535)))|/admin/inbox/find/([^/]++)(*:571))/?$}sDu',
    ),
    3 => 
    array (
      21 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'change.language',
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      46 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::rJl2AX4Aas3om58T',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      84 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::4zfqsvDQSl2xoBac',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      119 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'mitra.form',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      132 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'calonvendor.storependaftaran',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      169 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::5h11DfL4M2VxgkZv',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      200 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::8OeeLVZl1rFDIgCu',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      234 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::TEGQwJSRsoqpyEay',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      257 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Sb2dyub0DCVTasmj',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      279 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'titik-kami',
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      295 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'home',
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      318 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'become-partner',
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      336 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::TJJJpyLznOyXx8ZJ',
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      356 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'article.detail',
          ),
          1 => 
          array (
            0 => 'locale',
            1 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      376 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'article.tag',
          ),
          1 => 
          array (
            0 => 'locale',
            1 => 'tag',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      394 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::9tNxLC0JhAtMz3kf',
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      422 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Vu1owlCWnBV76hqQ',
          ),
          1 => 
          array (
            0 => 'locale',
            1 => 'province',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      439 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::D9p4mC3mPDPIowtO',
          ),
          1 => 
          array (
            0 => 'locale',
            1 => 'prvince',
            2 => 'city',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      466 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ZeN5xibGYqhJtP7y',
          ),
          1 => 
          array (
            0 => 'locale',
            1 => 'city',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      477 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::FT2fNOKERCvGum6q',
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      494 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::4hSpgFZ9tL8ljYNl',
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'POST' => 0,
            'GET' => 1,
            'HEAD' => 2,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      511 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::xnyt3Lg8DC651ZaG',
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      535 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::OBldRsL0RKkxKB6J',
          ),
          1 => 
          array (
            0 => 'locale',
            1 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      571 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dashboard.inbox.findInbox',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => NULL,
          1 => NULL,
          2 => NULL,
          3 => NULL,
          4 => false,
          5 => false,
          6 => 0,
        ),
      ),
    ),
    4 => NULL,
  ),
  'attributes' => 
  array (
    'sanctum.csrf-cookie' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'sanctum/csrf-cookie',
      'action' => 
      array (
        'uses' => 'Laravel\\Sanctum\\Http\\Controllers\\CsrfCookieController@show',
        'controller' => 'Laravel\\Sanctum\\Http\\Controllers\\CsrfCookieController@show',
        'namespace' => NULL,
        'prefix' => 'sanctum',
        'where' => 
        array (
        ),
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'sanctum.csrf-cookie',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ignition.healthCheck' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '_ignition/health-check',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'Spatie\\LaravelIgnition\\Http\\Middleware\\RunnableSolutionsEnabled',
        ),
        'uses' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\HealthCheckController@__invoke',
        'controller' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\HealthCheckController',
        'as' => 'ignition.healthCheck',
        'namespace' => NULL,
        'prefix' => '_ignition',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ignition.executeSolution' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '_ignition/execute-solution',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'Spatie\\LaravelIgnition\\Http\\Middleware\\RunnableSolutionsEnabled',
        ),
        'uses' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\ExecuteSolutionController@__invoke',
        'controller' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\ExecuteSolutionController',
        'as' => 'ignition.executeSolution',
        'namespace' => NULL,
        'prefix' => '_ignition',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ignition.updateConfig' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '_ignition/update-config',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'Spatie\\LaravelIgnition\\Http\\Middleware\\RunnableSolutionsEnabled',
        ),
        'uses' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\UpdateConfigController@__invoke',
        'controller' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\UpdateConfigController',
        'as' => 'ignition.updateConfig',
        'namespace' => NULL,
        'prefix' => '_ignition',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'change.language' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'lang/{locale}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:173:"function ($locale) {
    if (\\in_array($locale, [\'en\', \'id\'])) {
        \\Illuminate\\Support\\Facades\\Session::put(\'locale\', $locale);
    }
    return \\redirect()->back();
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000005600000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'change.language',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'login' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'POST',
        2 => 'HEAD',
      ),
      'uri' => 'login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\LoginController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\LoginController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'login',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::N9PaGT575a8wg0oN' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\LoginController@logout',
        'controller' => 'App\\Http\\Controllers\\Admin\\LoginController@logout',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::N9PaGT575a8wg0oN',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::6qNXyqXS5cCMltlo' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '/',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:75:"function () {
    return \\redirect(\'/id\'); // Ganti dengan bahasa default
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000005640000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::6qNXyqXS5cCMltlo',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hSotlzD5kzM2ANsv' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'map/data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\MapController@get_map_json',
        'controller' => 'App\\Http\\Controllers\\MapController@get_map_json',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::hSotlzD5kzM2ANsv',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::rJl2AX4Aas3om58T' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'map/data/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\MapController@get_map_by_id',
        'controller' => 'App\\Http\\Controllers\\MapController@get_map_by_id',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::rJl2AX4Aas3om58T',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::LsZiZBtybv8Oi64n' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'cek-map',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\MapController@index',
        'controller' => 'App\\Http\\Controllers\\MapController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::LsZiZBtybv8Oi64n',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::rdAZlZ8n4lE9wQFV' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'cek-map/data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\MapController@get_map_json',
        'controller' => 'App\\Http\\Controllers\\MapController@get_map_json',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::rdAZlZ8n4lE9wQFV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::4zfqsvDQSl2xoBac' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'cek-map/data-detail/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\MapController@get_map_by_id',
        'controller' => 'App\\Http\\Controllers\\MapController@get_map_by_id',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::4zfqsvDQSl2xoBac',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::T7BoTTRdXeFP9nsb' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'add-to-cart',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\CartController@addToCart',
        'controller' => 'App\\Http\\Controllers\\CartController@addToCart',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::T7BoTTRdXeFP9nsb',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::sjYtNUfnu5UOZPRR' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'remove-from-cart',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\CartController@removeFromCart',
        'controller' => 'App\\Http\\Controllers\\CartController@removeFromCart',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::sjYtNUfnu5UOZPRR',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::2E01yGDfupreUBQe' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'get-cart-items',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\CartController@getCartItems',
        'controller' => 'App\\Http\\Controllers\\CartController@getCartItems',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::2E01yGDfupreUBQe',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'useraffiliate.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'useraffiliate',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\UserAffiliateController@index',
        'controller' => 'App\\Http\\Controllers\\UserAffiliateController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'useraffiliate.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'useraffiliate.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'useraffiliate/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\UserAffiliateController@create',
        'controller' => 'App\\Http\\Controllers\\UserAffiliateController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'useraffiliate.create',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'useraffiliate.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'useraffiliate',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\UserAffiliateController@store',
        'controller' => 'App\\Http\\Controllers\\UserAffiliateController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'useraffiliate.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'calon-vendor.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'calon-vendor',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\CalonVendorController@create',
        'controller' => 'App\\Http\\Controllers\\CalonVendorController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'calon-vendor.create',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'calon-vendor.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'calon-vendor',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\CalonVendorController@store',
        'controller' => 'App\\Http\\Controllers\\CalonVendorController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'calon-vendor.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'mitra.form' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'daftar_mitra/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\CalonVendorController@show',
        'controller' => 'App\\Http\\Controllers\\CalonVendorController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'mitra.form',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'calonvendor.storependaftaran' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'daftar_mitra/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\CalonVendorController@storeFromPendaftaran',
        'controller' => 'App\\Http\\Controllers\\CalonVendorController@storeFromPendaftaran',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'calonvendor.storependaftaran',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Qf5fkMLmsFbaag1l' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'data/province',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProvinceController@province',
        'controller' => 'App\\Http\\Controllers\\ProvinceController@province',
        'namespace' => NULL,
        'prefix' => '/data',
        'where' => 
        array (
        ),
        'as' => 'generated::Qf5fkMLmsFbaag1l',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::5h11DfL4M2VxgkZv' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'data/province/{id}/city',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProvinceController@city',
        'controller' => 'App\\Http\\Controllers\\ProvinceController@city',
        'namespace' => NULL,
        'prefix' => '/data',
        'where' => 
        array (
        ),
        'as' => 'generated::5h11DfL4M2VxgkZv',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::jmevo9veIdf9OsHn' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'data/city',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProvinceController@cityAll',
        'controller' => 'App\\Http\\Controllers\\ProvinceController@cityAll',
        'namespace' => NULL,
        'prefix' => '/data',
        'where' => 
        array (
        ),
        'as' => 'generated::jmevo9veIdf9OsHn',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::x8ZbuMsEXTFj2esY' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'data/type',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ItemController@getType',
        'controller' => 'App\\Http\\Controllers\\ItemController@getType',
        'namespace' => NULL,
        'prefix' => '/data',
        'where' => 
        array (
        ),
        'as' => 'generated::x8ZbuMsEXTFj2esY',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::fBMhEgrogv7GqhwZ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'data/item/datatable',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ItemController@datatable',
        'controller' => 'App\\Http\\Controllers\\ItemController@datatable',
        'namespace' => NULL,
        'prefix' => 'data/item',
        'where' => 
        array (
        ),
        'as' => 'generated::fBMhEgrogv7GqhwZ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ltOR7w4EHop1NypR' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'data/item/card',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ItemController@cardItem',
        'controller' => 'App\\Http\\Controllers\\ItemController@cardItem',
        'namespace' => NULL,
        'prefix' => 'data/item',
        'where' => 
        array (
        ),
        'as' => 'generated::ltOR7w4EHop1NypR',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::8OeeLVZl1rFDIgCu' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'data/item/delete/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ItemController@delete',
        'controller' => 'App\\Http\\Controllers\\ItemController@delete',
        'namespace' => NULL,
        'prefix' => 'data/item',
        'where' => 
        array (
        ),
        'as' => 'generated::8OeeLVZl1rFDIgCu',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::sF5NzmZhKU0z7Z0T' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'data/item/post-item',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ItemController@postItem',
        'controller' => 'App\\Http\\Controllers\\ItemController@postItem',
        'namespace' => NULL,
        'prefix' => 'data/item',
        'where' => 
        array (
        ),
        'as' => 'generated::sF5NzmZhKU0z7Z0T',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::TEGQwJSRsoqpyEay' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'data/item/url-street-view/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ItemController@getUrlStreetView',
        'controller' => 'App\\Http\\Controllers\\ItemController@getUrlStreetView',
        'namespace' => NULL,
        'prefix' => 'data/item',
        'where' => 
        array (
        ),
        'as' => 'generated::TEGQwJSRsoqpyEay',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Sb2dyub0DCVTasmj' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'data/item/by-id/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ItemController@getItemByID',
        'controller' => 'App\\Http\\Controllers\\ItemController@getItemByID',
        'namespace' => NULL,
        'prefix' => 'data/item',
        'where' => 
        array (
        ),
        'as' => 'generated::Sb2dyub0DCVTasmj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::V0KLpEcn6lwiHMh1' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'data/item/show-data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ItemController@changeShowLandingPage',
        'controller' => 'App\\Http\\Controllers\\ItemController@changeShowLandingPage',
        'namespace' => NULL,
        'prefix' => 'data/item',
        'where' => 
        array (
        ),
        'as' => 'generated::V0KLpEcn6lwiHMh1',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::9vL3bLAj5cTWMlDd' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'data/item/generate-slug',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ItemController@generateSlug',
        'controller' => 'App\\Http\\Controllers\\ItemController@generateSlug',
        'namespace' => NULL,
        'prefix' => 'data/item',
        'where' => 
        array (
        ),
        'as' => 'generated::9vL3bLAj5cTWMlDd',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'titik-kami' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\TitikController@index',
        'controller' => 'App\\Http\\Controllers\\TitikController@index',
        'namespace' => NULL,
        'prefix' => '/{locale}',
        'where' => 
        array (
          'locale' => 'en|id',
        ),
        'as' => 'titik-kami',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'locale' => 'en|id',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'home' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale}/home',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@index',
        'controller' => 'App\\Http\\Controllers\\HomeController@index',
        'namespace' => NULL,
        'prefix' => '/{locale}',
        'where' => 
        array (
          'locale' => 'en|id',
        ),
        'as' => 'home',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'locale' => 'en|id',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'become-partner' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale}/become-partner',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\BecomePartnerController@index',
        'controller' => 'App\\Http\\Controllers\\BecomePartnerController@index',
        'namespace' => NULL,
        'prefix' => '/{locale}',
        'where' => 
        array (
          'locale' => 'en|id',
        ),
        'as' => 'become-partner',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'locale' => 'en|id',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::TJJJpyLznOyXx8ZJ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale}/artikel',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ArtikelController@index',
        'controller' => 'App\\Http\\Controllers\\ArtikelController@index',
        'namespace' => NULL,
        'prefix' => '{locale}/artikel',
        'where' => 
        array (
          'locale' => 'en|id',
        ),
        'as' => 'generated::TJJJpyLznOyXx8ZJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'locale' => 'en|id',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'article.detail' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale}/artikel/{slug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ArtikelController@detail',
        'controller' => 'App\\Http\\Controllers\\ArtikelController@detail',
        'namespace' => NULL,
        'prefix' => '{locale}/artikel',
        'where' => 
        array (
          'locale' => 'en|id',
        ),
        'as' => 'article.detail',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'locale' => 'en|id',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'article.tag' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale}/artikel/tag/{tag}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ArtikelController@byTag',
        'controller' => 'App\\Http\\Controllers\\ArtikelController@byTag',
        'namespace' => NULL,
        'prefix' => '{locale}/artikel',
        'where' => 
        array (
          'locale' => 'en|id',
        ),
        'as' => 'article.tag',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'locale' => 'en|id',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::9tNxLC0JhAtMz3kf' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale}/services',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ServiceController@index',
        'controller' => 'App\\Http\\Controllers\\ServiceController@index',
        'namespace' => NULL,
        'prefix' => '/{locale}',
        'where' => 
        array (
          'locale' => 'en|id',
        ),
        'as' => 'generated::9tNxLC0JhAtMz3kf',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'locale' => 'en|id',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Vu1owlCWnBV76hqQ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale}/titik/{province}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\TitikController@titikProvince',
        'controller' => 'App\\Http\\Controllers\\TitikController@titikProvince',
        'namespace' => NULL,
        'prefix' => '/{locale}',
        'where' => 
        array (
          'locale' => 'en|id',
        ),
        'as' => 'generated::Vu1owlCWnBV76hqQ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'locale' => 'en|id',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ZeN5xibGYqhJtP7y' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale}/titik-kota/{city}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\TitikController@titikCity',
        'controller' => 'App\\Http\\Controllers\\TitikController@titikCity',
        'namespace' => NULL,
        'prefix' => '/{locale}',
        'where' => 
        array (
          'locale' => 'en|id',
        ),
        'as' => 'generated::ZeN5xibGYqhJtP7y',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'locale' => 'en|id',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::D9p4mC3mPDPIowtO' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale}/titik/{prvince}/{city}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:64:"function () {
        return \\view(\'user.titik_per_kota\');
    }";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"000000000000058b0000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '/{locale}',
        'where' => 
        array (
          'locale' => 'en|id',
        ),
        'as' => 'generated::D9p4mC3mPDPIowtO',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'locale' => 'en|id',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::FT2fNOKERCvGum6q' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale}/titik-kami',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\TitikController@index',
        'controller' => 'App\\Http\\Controllers\\TitikController@index',
        'namespace' => NULL,
        'prefix' => '/{locale}',
        'where' => 
        array (
          'locale' => 'en|id',
        ),
        'as' => 'generated::FT2fNOKERCvGum6q',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'locale' => 'en|id',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::4hSpgFZ9tL8ljYNl' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
        1 => 'GET',
        2 => 'HEAD',
      ),
      'uri' => '{locale}/contact',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ContactController@index',
        'controller' => 'App\\Http\\Controllers\\ContactController@index',
        'namespace' => NULL,
        'prefix' => '/{locale}',
        'where' => 
        array (
          'locale' => 'en|id',
        ),
        'as' => 'generated::4hSpgFZ9tL8ljYNl',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'locale' => 'en|id',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::xnyt3Lg8DC651ZaG' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale}/portfolio',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\PortfolioController@index',
        'controller' => 'App\\Http\\Controllers\\PortfolioController@index',
        'namespace' => NULL,
        'prefix' => '/{locale}',
        'where' => 
        array (
          'locale' => 'en|id',
        ),
        'as' => 'generated::xnyt3Lg8DC651ZaG',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'locale' => 'en|id',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::OBldRsL0RKkxKB6J' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale}/listing/{slug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\TitikController@detail',
        'controller' => 'App\\Http\\Controllers\\TitikController@detail',
        'namespace' => NULL,
        'prefix' => '/{locale}',
        'where' => 
        array (
          'locale' => 'en|id',
        ),
        'as' => 'generated::OBldRsL0RKkxKB6J',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'locale' => 'en|id',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dashboard' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\DashboardController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\DashboardController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'admin.dashboard',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dashboard.titik' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/titik',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\DashboardController@getDataTitik',
        'controller' => 'App\\Http\\Controllers\\Admin\\DashboardController@getDataTitik',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'admin.dashboard.titik',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dashboard.titik.public' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/titik-public',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\DashboardController@getDataTitikPublic',
        'controller' => 'App\\Http\\Controllers\\Admin\\DashboardController@getDataTitikPublic',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'admin.dashboard.titik.public',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dashboard.article' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/article',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\DashboardController@getDataArticle',
        'controller' => 'App\\Http\\Controllers\\Admin\\DashboardController@getDataArticle',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'admin.dashboard.article',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dashboard.portfolio' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/dashboard-portfolio',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\DashboardController@getDataPortofolio',
        'controller' => 'App\\Http\\Controllers\\Admin\\DashboardController@getDataPortofolio',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'admin.dashboard.portfolio',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dashboard.inbox.datatable' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/inbox/datatable',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\InboxController@datatable',
        'controller' => 'App\\Http\\Controllers\\Admin\\InboxController@datatable',
        'namespace' => NULL,
        'prefix' => 'admin/inbox',
        'where' => 
        array (
        ),
        'as' => 'admin.dashboard.inbox.datatable',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dashboard.inbox.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/inbox/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\InboxController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\InboxController@delete',
        'namespace' => NULL,
        'prefix' => 'admin/inbox',
        'where' => 
        array (
        ),
        'as' => 'admin.dashboard.inbox.delete',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dashboard.inbox.notif' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/inbox/notif',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\InboxController@getInbox',
        'controller' => 'App\\Http\\Controllers\\Admin\\InboxController@getInbox',
        'namespace' => NULL,
        'prefix' => 'admin/inbox',
        'where' => 
        array (
        ),
        'as' => 'admin.dashboard.inbox.notif',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dashboard.inbox.findInbox' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/inbox/find/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\InboxController@findInbox',
        'controller' => 'App\\Http\\Controllers\\Admin\\InboxController@findInbox',
        'namespace' => NULL,
        'prefix' => 'admin/inbox',
        'where' => 
        array (
        ),
        'as' => 'admin.dashboard.inbox.findInbox',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.tags' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/tags',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\TagsController@getAll',
        'controller' => 'App\\Http\\Controllers\\Admin\\TagsController@getAll',
        'namespace' => NULL,
        'prefix' => 'admin/tags',
        'where' => 
        array (
        ),
        'as' => 'admin.tags',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.tags.add' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/tags/add',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\TagsController@postTag',
        'controller' => 'App\\Http\\Controllers\\Admin\\TagsController@postTag',
        'namespace' => NULL,
        'prefix' => 'admin/tags',
        'where' => 
        array (
        ),
        'as' => 'admin.tags.add',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.profile' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'POST',
        2 => 'HEAD',
      ),
      'uri' => 'admin/profile',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ProfileController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\ProfileController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'admin.profile',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.article.datatable' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/artikel/datatable',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ArticleController@datatable',
        'controller' => 'App\\Http\\Controllers\\Admin\\ArticleController@datatable',
        'namespace' => NULL,
        'prefix' => 'admin/artikel',
        'where' => 
        array (
        ),
        'as' => 'admin.article.datatable',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.article' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/artikel',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ArticleController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\ArticleController@index',
        'namespace' => NULL,
        'prefix' => 'admin/artikel',
        'where' => 
        array (
        ),
        'as' => 'admin.article',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.article.data' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'POST',
        2 => 'HEAD',
      ),
      'uri' => 'admin/artikel/data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ArticleController@pageAdd',
        'controller' => 'App\\Http\\Controllers\\Admin\\ArticleController@pageAdd',
        'namespace' => NULL,
        'prefix' => 'admin/artikel',
        'where' => 
        array (
        ),
        'as' => 'admin.article.data',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.article.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/artikel/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ArticleController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\ArticleController@delete',
        'namespace' => NULL,
        'prefix' => 'admin/artikel',
        'where' => 
        array (
        ),
        'as' => 'admin.article.delete',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.service.datatable' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/service/datatable',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ServiceController@datatable',
        'controller' => 'App\\Http\\Controllers\\Admin\\ServiceController@datatable',
        'namespace' => NULL,
        'prefix' => 'admin/service',
        'where' => 
        array (
        ),
        'as' => 'admin.service.datatable',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.service' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/service',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ServiceController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\ServiceController@index',
        'namespace' => NULL,
        'prefix' => 'admin/service',
        'where' => 
        array (
        ),
        'as' => 'admin.service',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.service.data' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'POST',
        2 => 'HEAD',
      ),
      'uri' => 'admin/service/data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ServiceController@pageAdd',
        'controller' => 'App\\Http\\Controllers\\Admin\\ServiceController@pageAdd',
        'namespace' => NULL,
        'prefix' => 'admin/service',
        'where' => 
        array (
        ),
        'as' => 'admin.service.data',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.service.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/service/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ServiceController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\ServiceController@delete',
        'namespace' => NULL,
        'prefix' => 'admin/service',
        'where' => 
        array (
        ),
        'as' => 'admin.service.delete',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.portfolio.datatable' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/portfolio/datatable',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\PortofolioController@datatable',
        'controller' => 'App\\Http\\Controllers\\Admin\\PortofolioController@datatable',
        'namespace' => NULL,
        'prefix' => 'admin/portfolio',
        'where' => 
        array (
        ),
        'as' => 'admin.portfolio.datatable',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.portfolio' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/portfolio',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\PortofolioController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\PortofolioController@index',
        'namespace' => NULL,
        'prefix' => 'admin/portfolio',
        'where' => 
        array (
        ),
        'as' => 'admin.portfolio',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.portfolio.data' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'POST',
        2 => 'HEAD',
      ),
      'uri' => 'admin/portfolio/data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\PortofolioController@pageAdd',
        'controller' => 'App\\Http\\Controllers\\Admin\\PortofolioController@pageAdd',
        'namespace' => NULL,
        'prefix' => 'admin/portfolio',
        'where' => 
        array (
        ),
        'as' => 'admin.portfolio.data',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.portfolio.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/portfolio/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\PortofolioController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\PortofolioController@delete',
        'namespace' => NULL,
        'prefix' => 'admin/portfolio',
        'where' => 
        array (
        ),
        'as' => 'admin.portfolio.delete',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.clients.datatable' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/clients/datatable',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ClientController@datatable',
        'controller' => 'App\\Http\\Controllers\\Admin\\ClientController@datatable',
        'namespace' => NULL,
        'prefix' => 'admin/clients',
        'where' => 
        array (
        ),
        'as' => 'admin.clients.datatable',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.clients' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/clients',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ClientController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\ClientController@index',
        'namespace' => NULL,
        'prefix' => 'admin/clients',
        'where' => 
        array (
        ),
        'as' => 'admin.clients',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.clients.data' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/clients/data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ClientController@pageAdd',
        'controller' => 'App\\Http\\Controllers\\Admin\\ClientController@pageAdd',
        'namespace' => NULL,
        'prefix' => 'admin/clients',
        'where' => 
        array (
        ),
        'as' => 'admin.clients.data',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.clients.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/clients/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ClientController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\ClientController@delete',
        'namespace' => NULL,
        'prefix' => 'admin/clients',
        'where' => 
        array (
        ),
        'as' => 'admin.clients.delete',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.about' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'POST',
        2 => 'HEAD',
      ),
      'uri' => 'admin/about',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\AboutController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\AboutController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'admin.about',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.testimoni.datatable' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/testimoni/datatable',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\TestimoniController@datatable',
        'controller' => 'App\\Http\\Controllers\\Admin\\TestimoniController@datatable',
        'namespace' => NULL,
        'prefix' => 'admin/testimoni',
        'where' => 
        array (
        ),
        'as' => 'admin.testimoni.datatable',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.testimoni' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/testimoni',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\TestimoniController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\TestimoniController@index',
        'namespace' => NULL,
        'prefix' => 'admin/testimoni',
        'where' => 
        array (
        ),
        'as' => 'admin.testimoni',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.testimoni.data' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/testimoni/data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\TestimoniController@pageAdd',
        'controller' => 'App\\Http\\Controllers\\Admin\\TestimoniController@pageAdd',
        'namespace' => NULL,
        'prefix' => 'admin/testimoni',
        'where' => 
        array (
        ),
        'as' => 'admin.testimoni.data',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.testimoni.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/testimoni/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\TestimoniController@delete',
        'controller' => 'App\\Http\\Controllers\\Admin\\TestimoniController@delete',
        'namespace' => NULL,
        'prefix' => 'admin/testimoni',
        'where' => 
        array (
        ),
        'as' => 'admin.testimoni.delete',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.analytics' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/analytics',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\AnalyticsController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\AnalyticsController@index',
        'namespace' => NULL,
        'prefix' => 'admin/analytics',
        'where' => 
        array (
        ),
        'as' => 'admin.analytics',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'analytics.monthly' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/analytics/data/monthly',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\AnalyticsController@getMonthlyData',
        'controller' => 'App\\Http\\Controllers\\Admin\\AnalyticsController@getMonthlyData',
        'namespace' => NULL,
        'prefix' => 'admin/analytics',
        'where' => 
        array (
        ),
        'as' => 'analytics.monthly',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'analytics.daily' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/analytics/data/daily',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\AnalyticsController@getDailyData',
        'controller' => 'App\\Http\\Controllers\\Admin\\AnalyticsController@getDailyData',
        'namespace' => NULL,
        'prefix' => 'admin/analytics',
        'where' => 
        array (
        ),
        'as' => 'analytics.daily',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'analytics.content' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/analytics/data/content',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\AnalyticsController@getTopContentData',
        'controller' => 'App\\Http\\Controllers\\Admin\\AnalyticsController@getTopContentData',
        'namespace' => NULL,
        'prefix' => 'admin/analytics',
        'where' => 
        array (
        ),
        'as' => 'analytics.content',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'analytics.city-date' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/analytics/data/city-date',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\AnalyticsController@getCityDataByDate',
        'controller' => 'App\\Http\\Controllers\\Admin\\AnalyticsController@getCityDataByDate',
        'namespace' => NULL,
        'prefix' => 'admin/analytics',
        'where' => 
        array (
        ),
        'as' => 'analytics.city-date',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'analytics.city-month' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/analytics/data/city-month',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\AnalyticsController@getCityDataByMonth',
        'controller' => 'App\\Http\\Controllers\\Admin\\AnalyticsController@getCityDataByMonth',
        'namespace' => NULL,
        'prefix' => 'admin/analytics',
        'where' => 
        array (
        ),
        'as' => 'analytics.city-month',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::eUJiXu0asQO9NmwF' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/inbox',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:62:"function () {
        return \\view(\'admin.inbox.inbox\');
    }";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"000000000000059f0000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
        'as' => 'generated::eUJiXu0asQO9NmwF',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::G2Btda1nIPiXlEIK' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/user',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:77:"function (\\Illuminate\\Http\\Request $request) {
    return $request->user();
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000005bb0000000000000000";}}',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::G2Btda1nIPiXlEIK',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
  ),
)
);
