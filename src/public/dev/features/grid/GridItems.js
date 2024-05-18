import React from 'react';
import { setIsMouseDown, setPixels } from './gridSlice';
import { useDispatch, useSelector } from 'react-redux';

const GridItems = (props) => {
    const {pixelData, isMouseDown, selectedColor } = useSelector((state) => state.grid);
    const dispatch = useDispatch();


    const changeGridColor = () => {
        let pixelsState = [...pixelData]
        pixelsState[props.index] = selectedColor;
        dispatch(setPixels(pixelsState));
    }
    const handleOnClick = () => {
        changeGridColor()
    }
    
    return (
        <div key={props.index} className="grid-item" style={{backgroundColor:props.color}} onClick={handleOnClick}/>
    )
}

export default GridItems