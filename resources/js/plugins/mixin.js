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
    objectToArray(objs,index) {
      let arr=[];

      for (let k = 0; k < objs.length; k++) {
        let arrObj=[];

        for (let i = 0; i < index.length; i++) {
          // Get the name and value of the old objsect
          let value = objs[k][index[i]];

          // Push the new objs[k]ect into the array of objs[k]ects
          arrObj.push(value);
        }
        arr.push(arrObj);

      }

      return arr
    }
  }
})
