const $ = document.querySelector.bind(document);
export default {
  methods: {
    toggleMenu() {

      if (document.getElementById('menu_btn')) {
        document.getElementById('menu_btn').classList.toggle('hidden');
      }

      document.getElementById('left_section').classList.toggle('hidden');

      document.getElementById('right_section').classList.toggle('right_section');
      document.getElementById('right_section').classList.toggle('full-width');
    },
    showLoading() {
      if (!$ || !$('.loading-component')) {
        return;
      }
      $('.loading-component').style.display = 'block';
    },
    hideLoading() {
      if (!$ || !$('.loading-component')) {
        return;
      }
      $('.loading-component').style.display = 'none';
    },
    goFormular() {
      window.open('https://cloudintegration.eu/formular');
    },
  }
};