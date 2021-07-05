<?php declare(strict_types=1);


namespace App\FrontendModule\Presenters;


use Nette\Application\UI\Presenter;

class HomepagePresenter extends Presenter
{
    public function actionDefault(): void
    {
        $this->sendJson([
            'Welcome' => 'To SnakeHammer Reports'
        ]);
    }

}