<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5>Theme Persistence Test</h5>
        </div>
        <div class="card-body">
            <p>This page tests theme persistence functionality:</p>
            <ol>
                <li>Open the settings panel (gear icon)</li>
                <li>Change theme mode (light/dark/auto)</li>
                <li>Change layout (vertical/horizontal/compact/tab)</li>
                <li>Change color preset</li>
                <li>Reload this page</li>
                <li>Your settings should persist!</li>
            </ol>

            <div class="alert alert-info">
                <h6>Current Theme Settings (from localStorage):</h6>
                <div id="current-settings">
                    <p><strong>Mode:</strong> <span id="current-mode">Loading...</span></p>
                    <p><strong>Layout:</strong> <span id="current-layout">Loading...</span></p>
                    <p><strong>Color Preset:</strong> <span id="current-preset">Loading...</span></p>
                    <p><strong>Sidebar Caption:</strong> <span id="current-caption">Loading...</span></p>
                    <p><strong>Direction:</strong> <span id="current-direction">Loading...</span></p>
                    <p><strong>Container:</strong> <span id="current-container">Loading...</span></p>
                </div>
            </div>

            <div class="mt-3">
                <button class="btn btn-primary" onclick="testThemePersistence()">Test Theme Persistence</button>
                <button class="btn btn-warning" onclick="clearThemeSettings()">Clear All Settings</button>
            </div>
        </div>
    </div>
</div>

<script>
    function testThemePersistence() {
        if (window.themeManager) {
            const settings = window.themeManager.loadSettings();
            document.getElementById('current-mode').textContent = settings.mode;
            document.getElementById('current-layout').textContent = settings.layout;
            document.getElementById('current-preset').textContent = settings.color_preset;
            document.getElementById('current-caption').textContent = settings.sidebar_caption ? 'Show' : 'Hide';
            document.getElementById('current-direction').textContent = settings.direction;
            document.getElementById('current-container').textContent = settings.container;
        } else {
            alert('ThemeManager not initialized yet');
        }
    }

    function clearThemeSettings() {
        if (window.themeManager) {
            window.themeManager.resetSettings();
            testThemePersistence();
            alert('All theme settings have been reset to default');
        }
    }

    // Auto-load settings when page loads
    document.addEventListener('DOMContentLoaded', function () {
        setTimeout(testThemePersistence, 1000); // Wait for ThemeManager to initialize
    });
</script>