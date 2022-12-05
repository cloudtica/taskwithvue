
import { Notify } from 'quasar'
export default {
  methods: {
    showErrorToast(message, dismiss_button = false) {
      // const $q = useQuasar();
      let note_data = {
        type: 'negative',
        message: message,
        position: 'bottom',
      };

      if (dismiss_button === true) {
        note_data['actions'] = [
          { label: 'Dismiss', color: 'white', handler: () => { /* ... */ } }
        ];
        note_data['timeout'] = 0;
      }

      // const dismiss = this.$q.notify(note_data);
      Notify.create(note_data);
      

      // store a reference to dismiss the notifications

      // if (this.notifications === null || this.notifications === undefined) {
      //   return;
      // }
      // this.notifications.push(dismiss);
    },
    showSuccessToast(message) {
      // const $q = useQuasar();
      this.$q.notify({
        color: 'primary',
        message: message
      });
    },
    showRulesNotFoundToast(data, current_url) {
      if (!data.hasOwnProperty('filter_values') || !data.filter_values || data.filter_values.length == 0) {
        let body = 'Document link: ' + current_url;
        let mailto = 'mailto:support@fellow-consulting.de?subject=Doc² Rules&body=' + body;
        // eslint-disable-next-line @typescript-eslint/no-unsafe-return
        return this.$q.notify({
          classes: 'warning_toast',
          type: 'warning',
          color: 'warning',
          position: 'bottom',
          message: 'Rules cannot be created. Please inform <a target="_blank" href="'+ mailto +'">us</a>',
          html: true,
          timeout: 0,
          actions: [
            { label: 'Dismiss', color: 'white', handler: () => { /* ... */ } }
          ]
        });
      }
      return {};
    },
    showWarningAlert(message) {
       
        // eslint-disable-next-line @typescript-eslint/no-unsafe-return
        return this.$q.notify({
          classes: 'warning_toast',
          type: 'warning',
          color: 'warning',
          position: 'bottom',
          message: message,
          timeout: 0,
          actions: [
            { label: 'Dismiss', color: 'white', handler: () => { /* ... */ } }
          ]
        });
    },
    showProcessMessage(message) {
      // eslint-disable-next-line @typescript-eslint/no-unsafe-return
      return  this.$q.notify({
        color: 'info',
        position: 'bottom',
        type: 'info',
        message: message,
        timeout: 0,
      });
    },
    // removeAllNotifications() {

    //   this.notifications.forEach((value, index) => {
    //     value();
    //   });

    // },
    showFullWidthToast(message, type='negative', dismiss_button = false) {
      // const $q = useQuasar();
      let note_data = {
        type: type,
        classes: 'q-notification-full-width full-width',
        position: 'top',
        message: message
      };

      if (dismiss_button === true) {
        note_data['actions'] = [
          { label: 'X', color: 'white', handler: () => { /* ... */ } }
        ];
        note_data['timeout'] = 0;
      }

      const dismiss = this.$q.notify(note_data);

      // store a reference to dismiss the notifications

      // if (this.notifications === null || this.notifications === undefined) {
      //   return;
      // }
      // this.notifications.push(dismiss);
    },
  }
};
