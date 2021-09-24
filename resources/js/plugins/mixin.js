import Vue from 'vue'
import store from '~/store'

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
    }
  }
})
