<?php

namespace Shopsys\FrameworkBundle\DataFixtures\Base;

use Doctrine\Common\Persistence\ObjectManager;
use Shopsys\FrameworkBundle\Component\DataFixture\AbstractReferenceFixture;
use Shopsys\FrameworkBundle\Component\Domain\Domain;
use Shopsys\FrameworkBundle\Component\Setting\Setting;
use Shopsys\FrameworkBundle\Component\Setting\SettingValue;
use Shopsys\FrameworkBundle\Component\Setting\SettingValueFactoryInterface;
use Shopsys\FrameworkBundle\Component\String\HashGenerator;
use Shopsys\FrameworkBundle\Model\Mail\Setting\MailSetting;
use Shopsys\FrameworkBundle\Model\Pricing\PricingSetting;
use Shopsys\FrameworkBundle\Model\Seo\SeoSettingFacade;

class SettingValueDataFixture extends AbstractReferenceFixture
{
    /**
     * @var \Shopsys\FrameworkBundle\Component\String\HashGenerator
     */
    private $hashGenerator;

    /**
     * @var \Shopsys\FrameworkBundle\Component\Setting\SettingValueFactoryInterface
     */
    protected $settingValueFactory;

    /**
     * @param \Shopsys\FrameworkBundle\Component\String\HashGenerator $hashGenerator
     * @param \Shopsys\FrameworkBundle\Component\Setting\SettingValueFactoryInterface $settingValueFactory
     */
    public function __construct(
        HashGenerator $hashGenerator,
        SettingValueFactoryInterface $settingValueFactory
    ) {
        $this->hashGenerator = $hashGenerator;
        $this->settingValueFactory = $settingValueFactory;
    }

    /**
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $orderSentText = '
            <p>
                Order number {number} has been sent, thank you for your purchase.
                We will contact you about next order status. <br /><br />
                <a href="{order_detail_url}">Track</a> the status of your order. <br />
                {transport_instructions} <br />
                {payment_instructions} <br />
            </p>
        ';

        $manager->persist($this->settingValueFactory->create(PricingSetting::INPUT_PRICE_TYPE, PricingSetting::INPUT_PRICE_TYPE_WITHOUT_VAT, SettingValue::DOMAIN_ID_COMMON));
        $manager->persist($this->settingValueFactory->create(PricingSetting::ROUNDING_TYPE, PricingSetting::ROUNDING_TYPE_INTEGER, SettingValue::DOMAIN_ID_COMMON));
        $manager->persist($this->settingValueFactory->create(Setting::ORDER_SENT_PAGE_CONTENT, $orderSentText, Domain::FIRST_DOMAIN_ID));
        $manager->persist($this->settingValueFactory->create(MailSetting::MAIN_ADMIN_MAIL, 'no-reply@shopsys.com', Domain::FIRST_DOMAIN_ID));
        $manager->persist($this->settingValueFactory->create(MailSetting::MAIN_ADMIN_MAIL_NAME, 'Shopsys', Domain::FIRST_DOMAIN_ID));
        $manager->persist($this->settingValueFactory->create(PricingSetting::FREE_TRANSPORT_AND_PAYMENT_PRICE_LIMIT, null, Domain::FIRST_DOMAIN_ID));
        $manager->persist($this->settingValueFactory->create(SeoSettingFacade::SEO_META_DESCRIPTION_MAIN_PAGE, 'Shopsys Framework - the best solution for your eshop.', Domain::FIRST_DOMAIN_ID));
        $manager->persist($this->settingValueFactory->create(SeoSettingFacade::SEO_TITLE_MAIN_PAGE, 'Shopsys Framework - Title page', Domain::FIRST_DOMAIN_ID));
        $manager->persist($this->settingValueFactory->create(SeoSettingFacade::SEO_TITLE_ADD_ON, '| Demo eshop', Domain::FIRST_DOMAIN_ID));
        $manager->persist($this->settingValueFactory->create(Setting::TERMS_AND_CONDITIONS_ARTICLE_ID, null, Domain::FIRST_DOMAIN_ID));
        $manager->persist($this->settingValueFactory->create(Setting::COOKIES_ARTICLE_ID, null, Domain::FIRST_DOMAIN_ID));
        $manager->persist($this->settingValueFactory->create(Setting::DOMAIN_DATA_CREATED, true, Domain::FIRST_DOMAIN_ID));
        $manager->persist($this->settingValueFactory->create(Setting::FEED_HASH, $this->hashGenerator->generateHash(10), SettingValue::DOMAIN_ID_COMMON));

        $manager->flush();
    }
}