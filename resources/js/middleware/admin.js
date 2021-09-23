import store from '~/store'

export default (to, from, next) => {
  if (store.getters['auth/user'].tipe !== 'Admin') {
    next({ name: 'home' })
  } else {
    next()
  }
}
