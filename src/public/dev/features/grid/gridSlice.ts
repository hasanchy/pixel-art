import { createAsyncThunk, createSlice } from '@reduxjs/toolkit';
import type { PayloadAction } from '@reduxjs/toolkit';
import axios from 'axios';
import appLocalizer from '../../types/global';

// Define the initial state using that type

const assignInitialPixels = () => {
    console.log('initial');
    
    let pixels = []
    for(let i = 0; i< 256; i++){
        pixels.push('');
    }
    return pixels;
}

const initialState = {
	pixels: assignInitialPixels(),
    isMouseDown: false,
    colorOptions:[ 'red', 'green', 'blue', 'yellow', 'purple', 'orange', 'pink', 'teal', 'brown', 'gray', 'transparent' ],
    selectedColor: 'red'
}

export const gridSlice = createSlice({
	name: 'grid',
	initialState,
	reducers: {
        setPixels: (state, action) => {
			state.pixels = action.payload;
		},
        setIsMouseDown: (state, action) => {
			state.isMouseDown = action.payload;
		},
        setSelectedColor: (state, action) => {
			state.selectedColor = action.payload;
		}
	},
	extraReducers: (builder) => {
	}
})

export const { setPixels, setIsMouseDown, setSelectedColor } = gridSlice.actions
export default gridSlice.reducer;