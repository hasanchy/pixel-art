import { ErrorBoundary } from "react-error-boundary";
import { Card, Space } from 'antd';
import Grid from "../grid/Grid";
import ColorPicker from "../grid/ColorPicker";

const App = (): JSX.Element => {
	return (
		<div className="wrap">
			<h1 style={{ fontFamily: 'Trebuchet MS',fontWeight:500, fontSize: '35px', marginBottom: '15px' }}><span style={{ color: '#eda93a' }}>Pixel</span><span style={{ color: '#674399' }}>Art</span></h1>
			<ErrorBoundary fallback={<div>Something went wrong</div>}>
				<Card>
					<Space direction="horizontal" style={{width: '100%', justifyContent: 'center'}}>
						<Grid />
					</Space>
					<Space direction="horizontal" style={{width: '100%', justifyContent: 'center'}}>
						<ColorPicker />
					</Space>
				</Card>
			</ErrorBoundary>
		</div>
	)
}

export default App;