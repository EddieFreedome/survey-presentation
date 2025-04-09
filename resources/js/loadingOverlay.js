/**
 * Loading Overlay Handler
 * 
 * This script manages the loading overlay display during page transitions,
 * including form submissions and link navigations.
 */

document.addEventListener('DOMContentLoaded', function() {
    // Function to show the loading overlay
    function showLoadingOverlay() {
        const overlay = document.getElementById('loading-overlay');
        if (overlay) {
            overlay.style.display = 'block';
        }
    }

    // Function to check if loading overlay should be shown
    function shouldShowOverlay() {
        return !document.body.hasAttribute('data-disable-loading-overlay');
    }

    // Handle form submissions
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(event) {
            // Don't show overlay if it's disabled for this page
            if (shouldShowOverlay()) {
                showLoadingOverlay();
            }
        });
    });

    // Handle link clicks (optional)
    document.addEventListener('click', function(event) {
        // Find closest anchor tag if the click was on a child element
        const link = event.target.closest('a');
        
        if (!link) return; // Not a link click
        
        // Skip if:
        // - It's not a link to another page (e.g., # links, javascript: links)
        // - It has target="_blank" (opens in new tab)
        // - It has a download attribute
        // - It has a data-no-loading attribute (for custom handling)
        if (
            link.getAttribute('href') === '#' ||
            link.getAttribute('href').startsWith('javascript:') ||
            link.getAttribute('target') === '_blank' ||
            link.hasAttribute('download') ||
            link.hasAttribute('data-no-loading')
        ) {
            return;
        }

        // Don't show overlay if it's disabled for this page
        if (shouldShowOverlay()) {
            showLoadingOverlay();
        }
    });

    // Fallback: beforeunload event
    window.addEventListener('beforeunload', function(event) {
        // Only show the overlay if:
        // 1. It's not already visible
        // 2. The page doesn't have the disable attribute
        const overlay = document.getElementById('loading-overlay');
        if (overlay && overlay.style.display !== 'block' && shouldShowOverlay()) {
            showLoadingOverlay();
        }
    });
});