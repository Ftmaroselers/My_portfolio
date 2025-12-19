 const errorMsg = document.querySelector('.error-message');
        const successMsg = document.querySelector('.success-message');

        [errorMsg, successMsg].forEach(msg => {
            if (msg) {
                setTimeout(() => {
                    msg.style.opacity = '0';
                    msg.style.maxHeight = '0';
                    msg.style.margin = '0';
                    setTimeout(() => msg.remove(), 500);
                }, 4000);
            }
        });