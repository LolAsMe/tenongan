import axios from 'axios'
import Cookies from 'js-cookie'

// state
export const state = {

  produks: [
  ]
}

// getters
export const getters = {
  produks: state => state.produks
}

// mutations
export const mutations = {
  setProduks: (state, produks) => (state.produks = produks),
  addProduk: (state, produk) => state.produks.push(produk),
  editProduk(state, nproduk){
    const oldproduk = state.produks.find( produk => produk.id === nproduk.id );
    if (oldproduk) {
      // not creating a new object but modifying old object here
      Object.assign(oldproduk, nproduk)
    }
  },
  deleteProduk: (state, id) => state.produks = state.produks.filter(produk => produk.id !== id)
}

// actions
export const actions = {
  async fetchProduks({ commit }){
    const { data } = await axios.get('/api/produk')
    commit('setProduks',data)
  },
}
