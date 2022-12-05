
import { LocalStorage, SessionStorage } from 'quasar';

export default {

    methods: {
        logout() {
            this.clearStorageForLogout();
            window.location.href = '/#/admin_login';
        },

        clearStorageForLogout() {
            LocalStorage.clear();
            SessionStorage.clear();
        },

        setDataToLocalStorage(key : string, obj: any) {
            LocalStorage.set(key, obj);
        },

        getDataFromLocalStorageByKey(key : string) {
            return LocalStorage.getItem(key);
        },

        setDataToSessionStorage(key : string, obj: any) {
            SessionStorage.set(key, obj);
        },

        getDataFromSessionStorageByKey(key : string) {
            return SessionStorage.getItem(key);
        },

    }
};
