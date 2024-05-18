import React from 'react';
import GridItems from './GridItems';
import { useSelector } from 'react-redux';

const Grid = () => {
    const {pixelData } = useSelector((state) => state.grid);
    
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