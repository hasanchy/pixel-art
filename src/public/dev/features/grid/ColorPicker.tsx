import React from 'react';
import { useAppDispatch, useAppSelector } from '../../store/hooks';
import { setSelectedColor } from './gridSlice';

const ColorPicker = () => {
    const {colorOptions, selectedColor } = useAppSelector((state) => state.grid);
    const dispatch = useAppDispatch();

    const handleColorSelection = (color) => {
        dispatch(setSelectedColor(color));
    }
    const renderColorButtons = () => {
        let buttonListHTML = [];
        let buttonClass, selected;
        colorOptions.forEach((color, i)=>{
            buttonClass = (color === 'transparent') ? 'pa-button-transparent' : 'pa-button';
            selected = (color === selectedColor) ? ' selected' : ''
            buttonListHTML.push(<div key={i} className={`${buttonClass}${selected}`} style={{backgroundColor:color}} onClick={handleColorSelection.bind(this, color)}/>)
        })

        return buttonListHTML;
    }

    return (
        <div>
            {renderColorButtons()}
        </div>
    )
}

export default ColorPicker