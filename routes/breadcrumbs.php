<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.

use App\Models\Brand;
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Trang chủ', route('home'));
});

Breadcrumbs::for('products', function (BreadcrumbTrail $trail, $brand_id) {
    $trail->parent('home');
    $category_name = 'Danh sách sản phẩm';
    if ($brand_id != 0) {
        $category_name = 'Sản phẩm '. Brand::where('brand_id', '=', $brand_id)->first()->brand_name;
    }
    $trail->push($category_name, route('products', $brand_id));
});

Breadcrumbs::for('detail', function (BreadcrumbTrail $trail, $phone_id, $detail_id, $specs_id, $brand_id, $title) {
    $trail->parent('products', $brand_id);
    $trail->push($title, route('detail', [$phone_id, $detail_id, $specs_id, $brand_id]));
});

Breadcrumbs::for('cart', function(BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Giỏ hàng', route('cart'));
});

Breadcrumbs::for('user.info', function(BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Thông tin cá nhân', route('user.info'));
});

Breadcrumbs::for('orderedCart', function(BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Tra cứu đơn hàng', route('orderedCart'));
});

?>