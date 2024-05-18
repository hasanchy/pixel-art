import { ErrorBoundary } from "react-error-boundary";
import { Button, Card, Col, Row, Space } from 'antd';
import Grid from "../grid/Grid";
import ColorPicker from "../grid/ColorPicker";
import { useAppDispatch, useAppSelector } from "../../store/hooks";
import { savePixelData } from "../grid/gridSlice";

const App = (): JSX.Element => {
	const dispatch = useAppDispatch();

	const { pixels } = useAppSelector((state) => state.grid);

	const handlePixelDataSave = () => {
		dispatch(savePixelData({data:pixels}));
	}

	return (
		<div className="wrap">
			<h1 style={{ fontFamily: 'Trebuchet MS',fontWeight:500, fontSize: '35px', marginBottom: '15px' }}><span style={{ color: '#eda93a' }}>Pixel</span><span style={{ color: '#674399' }}>Art</span></h1>
			<ErrorBoundary fallback={<div>Something went wrong</div>}>
				<Card>
					<Row justify="center">
						<Col>
							<Grid />
						</Col>
					</Row>
					<Row justify="center">
						<Col>
							<ColorPicker />
						</Col>
					</Row>
					<Row justify="center">
						<Col>
							<Button type="primary" disabled={false} loading={false} onClick={handlePixelDataSave}>Save</Button>
						</Col>
					</Row>
				</Card>
			</ErrorBoundary>
		</div>
	)
}

export default App;