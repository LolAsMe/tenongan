import Vue from 'vue'
import store from '~/store'
// Create our number formatter.
var formatter = new Intl.NumberFormat('en-US', {
  style: 'currency',
  currency: 'IDR',

  // These options are needed to round to whole numbers if that's what you want.
  //minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
  //maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
});

Vue.mixin({
  methods: {
    isRole(role) {
      if (store.getters['auth/check'] && role == store.getters['auth/user'].tipe) {
        return true
      } else {
        return false
      }
    },
    getOwnerId(){
      if (store.getters['auth/check']) {
        return store.getters['auth/user'].owner_id
      } else {
        return null
      }
    },
    toCurrency(number){
      return formatter.format(number); /* $2,500.00 */

    }
  }
})
