import axios from 'axios'
import Cookies from 'js-cookie'

// state
export const state = {
  produsens: [{nama:'a'}],

}

// getters
export const getters = {
  produsens: state => state.produsens,
}

// mutations
export const mutations = {
  setProdusens: (state, produsens) => (state.produsens = produsens),
  addProdusen: (state, produsen) => state.produsens.push(produsen),
  editProdusen(state, nProdusen){
    const oldProdusen = state.produsens.find( produsen => produsen.id === nProdusen.id );
    if (oldProdusen) {
      // not creating a new object but modifying old object here
      Object.assign(oldProdusen, nProdusen)
    }
  },
  deleteProdusen: (state, id) => state.produsens = state.produsens.filter(produsen => produsen.id !== id)
}

// actions
export const actions = {
  async fetchProdusen({ commit }){
    const { data } = await axios.get('/api/produsen')
    commit('setProdusens',data)
  }
}
