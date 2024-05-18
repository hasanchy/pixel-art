import { configureStore } from '@reduxjs/toolkit'
import gridReducer from "../features/grid/gridSlice";

const store = configureStore({
	reducer: {
		grid: gridReducer
	},
})
export type RootState = ReturnType<typeof store.getState>
export type AppDispatch = typeof store.dispatch

export default store;