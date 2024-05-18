import React from 'react';
import { useAppDispatch, useAppSelector } from '../../store/hooks';
import { setIsMouseDown, setPixels } from './gridSlice';

const GridItems = (props) => {
    const {pixels, isMouseDown } = useAppSelector((state) => state.grid);
    const dispatch = useAppDispatch();


    const changeGridColor = () => {
        let pixelsState = [...pixels]
        pixelsState[props.index] = 'red';
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