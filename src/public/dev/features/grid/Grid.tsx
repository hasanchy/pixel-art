import React from 'react';
import { useAppSelector } from '../../store/hooks';
import GridItems from './GridItems';

const Grid = () => {
    const {pixelData } = useAppSelector((state) => state.grid);
    
    const renderGridItems = () => {
        let gridItems = [];

        pixelData.forEach((color, index)=>{
            gridItems.push(<GridItems index={index} color={color} key={index}/>)
        })

        return gridItems;
    }
    

    return (
        <div className="grid-container">
            {renderGridItems()}
        </div>
    )
}

export default Grid