import axios from 'axios'
import Cookies from 'js-cookie'

// state
export const state = {
  transaksis: [
  ],

}

// getters
export const getters = {
  transaksis: state => state.transaksis,
}

// mutations
export const mutations = {
  setTransaksi: (state, transaksis) => (state.transaksis = transaksis),
  addSaldo: (state, transaksi) => state.transaksis.push(transaksi),
  editSaldo(state, nSaldo){
    const oldSaldo = state.transaksis.find( transaksi => transaksi.id === nSaldo.id );
    if (oldSaldo) {
      // not creating a new object but modifying old object here
      Object.assign(oldSaldo, nSaldo)
    }
  },
  deleteSaldo: (state, id) => state.transaksis = state.transaksis.filter(transaksi => transaksi.id !== id)
}

// actions
export const actions = {
  async fetchTransaksis({ commit }){
    const { data } = await axios.get('/api/transaksi/penjualan')
    commit('setTransaksi',data)
  }
}
