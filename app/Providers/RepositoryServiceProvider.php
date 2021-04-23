<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Eloquent\{
    CategoryRepository,
    CourseRepository,
    SectionRepository,
    LessonRepository,
    ContentRepository,
    CouponRepository,
    CourseTargetRepository,
    CartRepository,
    PaymentRepository,
    AuthorDashboardRepository,
    UserDashboardRepository,
    QuestionRepository,
    CommentRepository,
    ReviewRepository,
    MessageRepository,
    UserRepository,
    RevenueRepository,
    TransactionRepository,
    PayoutRepository,
    RefundRepository,
    AnnouncementRepository,
    CurrencyRepository,
    PageRepository,
    HomeRepository,
    LanguageRepository
};

use App\Repositories\Contracts\{
    ICategory,
    ICourse,
    ISection,
    ILesson,
    IContent,
    ICoupon,
    ICourseTarget,
    ICart,
    IPayment,
    IAuthorDashboard,
    IUserDashboard,
    IQuestion,
    IComment,
    IReview,
    IMessage,
    IUser,
    IRevenue,
    ITransaction,
    IPayout,
    IRefund,
    IAnnouncement,
    ICurrency,
    IPage,
    IHome,
    ILanguage
};

class RepositoryServiceProvider extends ServiceProvider
{
 
    public function boot()
    {
        
        $this->app->bind(ICategory::class, CategoryRepository::class);
        $this->app->bind(ICourse::class, CourseRepository::class);
        $this->app->bind(ISection::class, SectionRepository::class);
        $this->app->bind(ILesson::class, LessonRepository::class);
        $this->app->bind(IContent::class, ContentRepository::class);
        $this->app->bind(ICoupon::class, CouponRepository::class);
        $this->app->bind(ICourseTarget::class, CourseTargetRepository::class);
        $this->app->bind(ICart::class, CartRepository::class);
        $this->app->bind(IPayment::class, PaymentRepository::class);
        $this->app->bind(IAuthorDashboard::class, AuthorDashboardRepository::class);
        $this->app->bind(IQuestion::class, QuestionRepository::class);
        $this->app->bind(IComment::class, CommentRepository::class);
        $this->app->bind(IReview::class, ReviewRepository::class);
        $this->app->bind(IUserDashboard::class, UserDashboardRepository::class);
        $this->app->bind(IMessage::class, MessageRepository::class);
        $this->app->bind(IUser::class, UserRepository::class);
        $this->app->bind(IRevenue::class, RevenueRepository::class);
        $this->app->bind(ITransaction::class, TransactionRepository::class);
        $this->app->bind(IPayout::class, PayoutRepository::class);
        $this->app->bind(IRefund::class, RefundRepository::class);
        $this->app->bind(IAnnouncement::class, AnnouncementRepository::class);
        $this->app->bind(ICurrency::class, CurrencyRepository::class);
        $this->app->bind(IPage::class, PageRepository::class);
        $this->app->bind(IHome::class, HomeRepository::class);
        $this->app->bind(ILanguage::class, LanguageRepository::class);
        
    }
}
