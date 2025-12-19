const errorMsg = document.getElementById('errorMessage');
        if (errorMsg) {
            setTimeout(() => {
                errorMsg.style.opacity = '0';
                errorMsg.style.maxHeight = '0';
                errorMsg.style.margin = '0';
                // Remove from DOM after transition
                setTimeout(() => {
                    errorMsg.remove();
                }, 500); // match the CSS transition time
            }, 4000); // wait 4 seconds before fading
        }