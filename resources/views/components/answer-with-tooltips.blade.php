@props([
    'answer' => '',
])

<div 
    {{ $attributes->merge(['class' => 'text-gray-800 prose prose-sm max-w-none [&>p]:mb-4 [&>p]:leading-relaxed answer-with-tooltips']) }}
>
    {!! $answer !!}
</div>

<style>
    .word-tooltip {
        border-bottom: 2px dotted #3b82f6;
        cursor: help;
        color: #404040;
        font-weight: 500;
        transition: all 0.2s ease;
        position: relative;
    }

    .word-tooltip:hover {
        background-color: #eff6ff;
        border-bottom-color: #1e40af;
    }

    .word-tooltip-popup {
        position: fixed;
        background-color: #1f2937;
        color: white;
        padding: 10px 14px;
        border-radius: 6px;
        font-size: 14px;
        z-index: 9999;
        max-width: 280px;
        word-wrap: break-word;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);
        pointer-events: none;
        animation: tooltipFadeIn 0.15s ease;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }

    .word-tooltip-popup::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 0;
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        border-top: 5px solid #1f2937;
    }

    @keyframes tooltipFadeIn {
        from {
            opacity: 0;
            transform: translateY(-8px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<script>
(function() {
    let currentTooltip = null;

    function createTooltip(word, meaning) {
        const tooltip = document.createElement('div');
        tooltip.className = 'word-tooltip-popup';
        tooltip.innerHTML = `<strong>${escapeHtml(word)}:</strong> ${escapeHtml(meaning)}`;
        return tooltip;
    }

    function escapeHtml(text) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, m => map[m]);
    }

    function positionTooltip(tooltip, element) {
        document.body.appendChild(tooltip);
        
        const rect = element.getBoundingClientRect();
        let top = rect.top + window.scrollY - tooltip.offsetHeight - 12;
        let left = rect.left + window.scrollX + (rect.width / 2) - (tooltip.offsetWidth / 2);

        // Adjust if tooltip goes off screen horizontally
        if (left < 10) {
            left = 10;
            tooltip.style.setProperty('--arrow-position', (rect.left + window.scrollX + rect.width / 2 - left) + 'px', 'important');
        } else if (left + tooltip.offsetWidth > window.innerWidth - 10) {
            left = window.innerWidth - tooltip.offsetWidth - 10;
            tooltip.style.setProperty('--arrow-position', (rect.left + window.scrollX + rect.width / 2 - left) + 'px', 'important');
        }

        // Adjust if tooltip goes off screen vertically
        if (top < 10) {
            top = rect.bottom + window.scrollY + 8;
        }

        tooltip.style.top = top + 'px';
        tooltip.style.left = left + 'px';
    }

    document.addEventListener('mouseenter', function(e) {
        if (e.target.classList.contains('word-tooltip')) {
            const word = e.target.getAttribute('data-word');
            const meaning = e.target.getAttribute('data-meaning');

            if (currentTooltip) {
                currentTooltip.remove();
            }

            const tooltip = createTooltip(word, meaning);
            currentTooltip = tooltip;
            positionTooltip(tooltip, e.target);
        }
    }, true);

    document.addEventListener('mouseleave', function(e) {
        if (e.target.classList.contains('word-tooltip') && currentTooltip) {
            currentTooltip.remove();
            currentTooltip = null;
        }
    }, true);
})();
</script>

