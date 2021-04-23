import 'izitoast/dist/css/iziToast.min.css'
import iZtoast from 'izitoast'

// By default, all ES6 modules are in Strict mode so no need to explicitly define it here
const toast = {
    error: (message, title = 'Error') => {
        return iZtoast.error({
            title: title,
            message: message,
            position: 'topCenter'
        });
    },
    success: (message, title = 'Success') => {
        return iZtoast.success({
            title: title,
            message: message,
            position: 'bottomCenter'
        });
    }
};

export default toast;