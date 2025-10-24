<?php

namespace App\Libraries;

class ThemeService
{
    protected $config;
    protected $session;

    public function __construct()
    {
        $this->config = config('App');
        $this->session = session();
    }

    /**
     * Get current theme configuration
     */
    public function getThemeConfig(): array
    {
        return [
            'mode' => $this->getThemeMode(),
            'layout' => $this->getLayout(),
            'sidebar_caption' => $this->getSidebarCaption(),
            'direction' => $this->getDirection(),
            'container' => $this->getContainer(),
            'color_preset' => $this->getColorPreset(),
            'contrast' => $this->getContrast()
        ];
    }

    /**
     * Get theme mode (light/dark/auto)
     */
    public function getThemeMode(): string
    {
        return $this->session->get('theme_mode') ?? 'light';
    }

    /**
     * Set theme mode
     */
    public function setThemeMode(string $mode): void
    {
        $this->session->set('theme_mode', $mode);
    }

    /**
     * Get layout type
     */
    public function getLayout(): string
    {
        return $this->session->get('theme_layout') ?? 'vertical';
    }

    /**
     * Set layout type
     */
    public function setLayout(string $layout): void
    {
        $this->session->set('theme_layout', $layout);
    }

    /**
     * Get sidebar caption setting
     */
    public function getSidebarCaption(): bool
    {
        return $this->session->get('sidebar_caption') ?? true;
    }

    /**
     * Set sidebar caption
     */
    public function setSidebarCaption(bool $caption): void
    {
        $this->session->set('sidebar_caption', $caption);
    }

    /**
     * Get direction (ltr/rtl)
     */
    public function getDirection(): string
    {
        return $this->session->get('theme_direction') ?? 'ltr';
    }

    /**
     * Set direction
     */
    public function setDirection(string $direction): void
    {
        $this->session->set('theme_direction', $direction);
    }

    /**
     * Get container type
     */
    public function getContainer(): string
    {
        return $this->session->get('theme_container') ?? 'full';
    }

    /**
     * Set container type
     */
    public function setContainer(string $container): void
    {
        $this->session->set('theme_container', $container);
    }

    /**
     * Get color preset
     */
    public function getColorPreset(): string
    {
        return $this->session->get('color_preset') ?? 'preset-1';
    }

    /**
     * Set color preset
     */
    public function setColorPreset(string $preset): void
    {
        $this->session->set('color_preset', $preset);
    }

    /**
     * Get contrast setting
     */
    public function getContrast(): bool
    {
        return $this->session->get('theme_contrast') ?? false;
    }

    /**
     * Set contrast
     */
    public function setContrast(bool $contrast): void
    {
        $this->session->set('theme_contrast', $contrast);
    }

    /**
     * Reset all theme settings to default
     */
    public function resetTheme(): void
    {
        $this->session->remove([
            'theme_mode',
            'theme_layout',
            'sidebar_caption',
            'theme_direction',
            'theme_container',
            'color_preset',
            'theme_contrast'
        ]);
    }

    /**
     * Get theme CSS classes for body
     */
    public function getBodyClasses(): string
    {
        $config = $this->getThemeConfig();

        $classes = [
            'data-pc-preset' => $config['color_preset'],
            'data-pc-sidebar-caption' => $config['sidebar_caption'] ? 'true' : 'false',
            'data-pc-layout' => $config['layout'],
            'data-pc-direction' => $config['direction'],
            'data-pc-theme_contrast' => $config['contrast'] ? 'true' : 'false',
            'data-pc-theme' => $config['mode']
        ];

        $classString = '';
        foreach ($classes as $attr => $value) {
            $classString .= " {$attr}=\"{$value}\"";
        }

        return $classString;
    }

    /**
     * Get theme assets path
     */
    public function getThemePath(): string
    {
        return base_url('themes/able-pro-admin');
    }

    /**
     * Get CSS file path
     */
    public function getCssPath(string $file = 'style.css'): string
    {
        return $this->getThemePath() . "/assets/css/{$file}";
    }

    /**
     * Get JS file path
     */
    public function getJsPath(string $file = 'pcoded.js'): string
    {
        return $this->getThemePath() . "/assets/js/{$file}";
    }

    /**
     * Get image path
     */
    public function getImagePath(string $file): string
    {
        return $this->getThemePath() . "/assets/images/{$file}";
    }
}
