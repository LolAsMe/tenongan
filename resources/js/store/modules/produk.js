import axios from 'axios'
import Cookies from 'js-cookie'

// state
export const state = {

  produks: [
    {nama:'test'}
  ],
  produsenId: 0,
}

// getters
export const getters = {
  produks: state => state.produks,
  produsenId: state => state.produsenId
}

// mutations
export const mutations = {
  setProduks: (state, produks) => (state.produks = produks),
  setProdusenId: (state, produsenId) => (state.produsenId = produsenId),
  addProduk: (state, produk) => state.produks.push(produk),
  editProduk(state, nProduk) {
    const oldproduk = state.produks.find(produk => produk.id === nProduk.id);
    if (oldproduk) {
      // not creating a new object but modifying old object here
      Object.assign(oldproduk, nProduk)
    }
  },
  deleteProduk: (state, id) => state.produks = state.produks.filter(produk => produk.id !== id)
}

// actions
export const actions = {
  async fetchProduks({ commit }) {
      const { data } = await axios.get('/api/produk')
      commit('setProduks', data)
  },
}
