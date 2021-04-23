<?php

return [
    // Translation
    ['method' => 'POST', 'uri' => 'admin/translations/add/{groupKey}'],
    ['method' => 'POST', 'uri' => 'admin/translations/edit/{groupKey}'],
    ['method' => 'POST', 'uri' => 'admin/translations/groups/add'],
    ['method' => 'POST', 'uri' => 'admin/translations/delete/{groupKey}/{translationKey}'],
    ['method' => 'POST', 'uri' => 'admin/translations/import'],
    ['method' => 'POST', 'uri' => 'admin/translations/find'],
    ['method' => 'POST', 'uri' => 'admin/translations/locales/add'],
    ['method' => 'POST', 'uri' => 'admin/translations/locales/remove'],
    ['method' => 'POST', 'uri' => 'admin/translations/publish/{groupKey}'],
    ['method' => 'POST', 'uri' => 'admin/translations/translate-missing'],

    // Installation
    ['method' => 'POST', 'uri' => 'api/installer/requirements'],
    ['method' => 'POST', 'uri' => 'api/installer/database'],
    ['method' => 'POST', 'uri' => 'api/installer/settings'],
    ['method' => 'POST', 'uri' => 'api/installer/mail'],
    ['method' => 'POST', 'uri' => 'api/installer/finish'],
    ['method' => 'POST', 'uri' => 'api/installer/license'],
    ['method' => 'POST', 'uri' => 'api/installer/update'],

    // Authentication
    ['method' => 'POST', 'uri' => 'api/logout'],
    ['method' => 'POST', 'uri' => 'api/login'],
    ['method' => 'POST', 'uri' => 'api/register'],
    ['method' => 'POST', 'uri' => 'api/password/email'],
    ['method' => 'POST', 'uri' => 'api/password/reset'],
    ['method' => 'POST', 'uri' => 'api/email/verify/{user}'],
    ['method' => 'POST', 'uri' => 'api/email/resend'],

    // Categories
    ['method' => 'POST', 'uri' => 'api/categories'],
    ['method' => 'PUT', 'uri' => 'api/categories/{category}'],
    ['method' => 'DELETE', 'uri' => 'api/categories/{category}'],

    // Content
    ['method' => 'POST', 'uri' => 'api/contents/{id}/update-duration'],

    // Cart
    //['method' => 'POST', 'uri' => 'api/cart'],
    //['method' => 'POST', 'uri' => 'api/cart/items/remove'],
    //['method' => 'POST', 'uri' => 'api/cart/applyCoupon'],
    //['method' => 'POST', 'uri' => 'api/cart/removeCoupon'],

    
    ['method' => 'POST', 'uri' => 'api/settings/picture/upload'],
    ['method' => 'PUT', 'uri' => 'api/settings/profile'],
    ['method' => 'PUT', 'uri' => 'api/settings/payout'],
    ['method' => 'PUT', 'uri' => 'api/settings/password'],
    
    ['method' => 'POST', 'uri' => 'api/courses/upload-cover-image/{id}'],
    //['method' => 'POST', 'uri' => 'api/lessons/{id}/video/upload'],
    ['method' => 'POST', 'uri' => 'api/courses'],
    ['method' => 'PUT', 'uri' => 'api/courses/{course}'],
    ['method' => 'DELETE', 'uri' => 'api/courses/{course}'],
    ['method' => 'POST', 'uri' => 'api/course/{id}/target'],
    ['method' => 'POST', 'uri' => 'api/sections'],
    ['method' => 'PUT', 'uri' => 'api/sections/{section}'],
    ['method' => 'DELETE', 'uri' => 'api/sections/{section}'],

    ['method' => 'POST', 'uri' => 'api/lessons'],
    ['method' => 'PUT', 'uri' => 'api/lessons/{lesson}'],
    ['method' => 'DELETE', 'uri' => 'api/lessons/{lesson}'],
    ['method' => 'POST', 'uri' => 'api/contents'],

    // ['method' => 'PUT', 'uri' => 'api/coupons/{id}/activate'],
    // ['method' => 'POST', 'uri' => 'api/coupons'],
    // ['method' => 'PUT', 'uri' => 'api/coupons/{coupon}'],
    // ['method' => 'DELETE', 'uri' => 'api/coupons/{coupon}'],
    ['method' => 'POST', 'uri' => 'api/announcements'],
    ['method' => 'PUT', 'uri' => 'api/announcements/{id}/update'],
    ['method' => 'DELETE', 'uri' => 'api/announcements/{uuid}'],
    //['method' => 'POST', 'uri' => 'api/admin/course/{uuid}/approve'],

    ['method' => 'POST', 'uri' => 'api/admin/categories'],
    ['method' => 'PUT', 'uri' => 'api/admin/category/{id}'],
    ['method' => 'DELETE', 'uri' => 'api/admin/category/{id}'],
    ['method' => 'POST', 'uri' => 'api/admin/update_categories_order'],
    ['method' => 'POST', 'uri' => 'api/admin/user/enroll'],
    ['method' => 'POST', 'uri' => 'api/admin/currencies'],
    ['method' => 'PUT', 'uri' => 'api/admin/currencies/{id}'],
    ['method' => 'DELETE', 'uri' => 'api/admin/currencies/{id}'],
    ['method' => 'PUT', 'uri' => 'api/admin/currency/{id}/mark_as_primary'],
    ['method' => 'PUT', 'uri' => 'api/admin/currency/{id}/toggle_enabled'],

    ['method' => 'POST', 'uri' => 'api/admin/settings/payment'],
    ['method' => 'POST', 'uri' => 'api/admin/settings/site'],
    ['method' => 'POST', 'uri' => 'api/admin/settings/mail'],
    ['method' => 'POST', 'uri' => 'api/admin/settings/upload'],
    ['method' => 'POST', 'uri' => 'api/admin/settings/theme'],
    
    ['method' => 'POST', 'uri' => 'api/admin/pages'],
    ['method' => 'POST', 'uri' => 'api/admin/empty_database'],
    
    ['method' => 'PUT', 'uri' => 'api/admin/page/{uuid}'],
    ['method' => 'PUT', 'uri' => 'api/admin/page/{id}/update_slug'],
    ['method' => 'PUT', 'uri' => 'api/admin/page/{id}/toggle_publish'],
    ['method' => 'DELETE', 'uri' => 'api/admin/pages/{id}'],
    ['method' => 'PATCH', 'uri' => 'password/expired'],
    ['method' => 'POST', 'uri' => 'login'],
    ['method' => 'POST', 'uri' => 'register'],
    ['method' => 'POST', 'uri' => 'password/email'],
    ['method' => 'POST', 'uri' => 'password/reset'],
    ['method' => 'POST', 'uri' => 'contact/send'],
    ['method' => 'PATCH', 'uri' => 'profile/update'],
    ['method' => 'POST', 'uri' => 'admin/auth/user'],
    ['method' => 'PATCH', 'uri' => 'admin/auth/user/{user}'],
    ['method' => 'DELETE', 'uri' => 'admin/auth/user/{user}'],
    ['method' => 'DELETE', 'uri' => 'admin/auth/user/{user}/social/{social}/unlink'],
    ['method' => 'PATCH', 'uri' => 'admin/auth/user/{user}/password/change'],
    ['method' => 'POST', 'uri' => 'admin/auth/role'],
    ['method' => 'PATCH', 'uri' => 'admin/auth/role/{role}'],
    ['method' => 'DELETE', 'uri' => 'admin/auth/role/{role}'],

    ['method' => 'PUT', 'uri' => 'api/admin/languages/{id}'],
    ['method' => 'POST', 'uri' => 'api/admin/languages'],
    ['method' => 'POST', 'uri' => 'admin/languages/{language}'],
    ['method' => 'DELETE', 'uri' => 'api/admin/languages/{id}'],
    

];