<?php

namespace App\Controllers;

use App\Libraries\ThemeService;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class BaseThemeController extends BaseController
{
    protected $themeService;
    protected $data = [];

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->themeService = new ThemeService();

        // Set common data for all views
        $this->data['themePath'] = $this->themeService->getThemePath();
        $this->data['pageTitle'] = 'Dashboard';
        $this->data['breadcrumb'] = [];
    }

    /**
     * Render view with theme layout.
     */
    protected function renderView(string $view, array $data = [], string $layout = 'main'): string
    {
        $this->data = array_merge($this->data, $data);
        $layoutData = $this->data;
        $layoutData['content'] = view($view, $this->data);
        $layoutData['test'] = 'test value';

        // Extract variables for layout
        extract($layoutData);

        return view("layouts/{$layout}", $layoutData);
    }

    /**
     * Render admin view.
     */
    protected function renderAdminView(string $view, array $data = []): string
    {
        return $this->renderView($view, $data, 'admin');
    }

    /**
     * Render auth view.
     */
    protected function renderAuthView(string $view, array $data = []): string
    {
        return $this->renderView($view, $data, 'auth');
    }

    /**
     * Get theme service.
     */
    protected function getThemeService(): ThemeService
    {
        return $this->themeService;
    }

    /**
     * Set page title.
     */
    protected function setPageTitle(string $title): void
    {
        $this->data['pageTitle'] = $title;
    }

    /**
     * Set breadcrumb.
     */
    protected function setBreadcrumb(array $breadcrumb): void
    {
        $this->data['breadcrumb'] = $breadcrumb;
    }

    /**
     * Add CSS file.
     */
    protected function addCss(string $file): void
    {
        if (!isset($this->data['additionalCss'])) {
            $this->data['additionalCss'] = [];
        }
        $this->data['additionalCss'][] = $file;
    }

    /**
     * Add JS file.
     */
    protected function addJs(string $file): void
    {
        if (!isset($this->data['additionalJs'])) {
            $this->data['additionalJs'] = [];
        }
        $this->data['additionalJs'][] = $file;
    }
}
